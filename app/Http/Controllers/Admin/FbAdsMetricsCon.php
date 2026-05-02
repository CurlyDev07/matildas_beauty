<?php

namespace App\Http\Controllers\Admin;

use App\FbAdsMetric;
use App\FbAdsMetricUpload;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class FbAdsMetricsCon extends Controller
{
    private const HEADER_MAP = [
        'Reporting starts' => 'reporting_starts',
        'Reporting ends' => 'reporting_ends',
        'Ad name' => 'ad_name',
        'Date created' => 'date_created',
        'Date last edited' => 'date_last_edited',
        'Last significant edit' => 'last_significant_edit',
        'Campaign name' => 'campaign_name',
        'Campaign ID' => 'campaign_id',
        'Ad set name' => 'ad_set_name',
        'Ad set ID' => 'ad_set_id',
        'Ad ID' => 'ad_id',
        'Ad delivery' => 'ad_delivery',
        'Ad set delivery' => 'ad_set_delivery',
        'Attribution setting' => 'attribution_setting',
        'Amount spent (PHP)' => 'amount_spent_php',
        'Reach' => 'reach',
        'Impressions' => 'impressions',
        'Frequency' => 'frequency',
        'CPM (cost per 1,000 impressions) (PHP)' => 'cpm_php',
        'Clicks (all)' => 'clicks_all',
        'CTR (all)' => 'ctr_all',
        'CPC (all) (PHP)' => 'cpc_all_php',
        'Link clicks' => 'link_clicks',
        'CTR (link click-through rate)' => 'ctr_link_click_through_rate',
        'CPC (cost per link click) (PHP)' => 'cpc_cost_per_link_click_php',
        'Landing page views' => 'landing_page_views',
        'Cost per landing page view (PHP)' => 'cost_per_landing_page_view_php',
        'Landing page views rate per link clicks' => 'landing_page_views_rate_per_link_clicks',
        'Content views' => 'content_views',
        'Content views conversion value' => 'content_views_conversion_value',
        'Adds to cart' => 'adds_to_cart',
        'Cost per add to cart (PHP)' => 'cost_per_add_to_cart_php',
        'INITIATE CHECK OUT RATE' => 'initiate_check_out_rate',
        'Purchases' => 'purchases',
        'Cost per purchase (PHP)' => 'cost_per_purchase_php',
        'Purchases conversion value' => 'purchases_conversion_value',
        'Purchase ROAS (return on ad spend)' => 'purchase_roas_return_on_ad_spend',
        '3-second video plays' => 'three_second_video_plays',
        '3-second video plays rate per impressions' => 'three_second_video_plays_rate_per_impressions',
        'Cost per 3-second video play (PHP)' => 'cost_per_three_second_video_play_php',
        'ThruPlays' => 'thruplays',
        'Cost per ThruPlay (PHP)' => 'cost_per_thruplay_php',
        'Video plays at 25%' => 'video_plays_at_25',
        'Video plays at 50%' => 'video_plays_at_50',
        'Video plays at 95%' => 'video_plays_at_95',
        'Video plays at 75%' => 'video_plays_at_75',
        'Video plays at 100%' => 'video_plays_at_100',
        'Video plays' => 'video_plays',
        'Video average play time' => 'video_average_play_time',
        'Post engagements' => 'post_engagements',
        'Cost per post engagement (PHP)' => 'cost_per_post_engagement_php',
        'Post reactions' => 'post_reactions',
        'Post comments' => 'post_comments',
        'Post saves' => 'post_saves',
        'Post shares' => 'post_shares',
        'Quality ranking' => 'quality_ranking',
        'Engagement rate ranking' => 'engagement_rate_ranking',
        'Conversion rate ranking' => 'conversion_rate_ranking',
        'Hook Rate' => 'hook_rate',
    ];

    public function index()
    {
        $uploads = FbAdsMetricUpload::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.fbads.metrics', compact('uploads'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
            'exported_date' => 'required|date',
        ]);

        $file = $request->file('excel_file');
        $tempPath = $file->getRealPath();
        if (!$tempPath || !file_exists($tempPath)) {
            return redirect()->back()->with('error', 'Uploaded temporary file is missing.');
        }

        $storedFileName = uniqid('fb_metrics_', true) . '.' . $file->getClientOriginalExtension();
        $storedPath = $file->storeAs('fb_ads_metrics', $storedFileName, 'public');
        if (!$storedPath) {
            return redirect()->back()->with('error', 'Failed to store uploaded file.');
        }

        $upload = FbAdsMetricUpload::create([
            'original_file_name' => $file->getClientOriginalName(),
            'stored_file_name' => $storedFileName,
            'file_path' => $storedPath,
            'exported_date' => $request->exported_date,
            'uploaded_by' => optional(auth()->user())->id,
            'rows_imported' => 0,
        ]);

        $spreadsheet = IOFactory::load($tempPath);
        $sheet = $spreadsheet->getSheet(0);
        $rows = $sheet->toArray(null, true, true, false);

        if (count($rows) < 2) {
            return redirect()->back()->with('error', 'Uploaded file is empty.');
        }

        $headerRow = array_map('trim', $rows[0]);
        $headerIndexMap = [];
        foreach ($headerRow as $idx => $headerText) {
            $headerIndexMap[$headerText] = $idx;
        }

        DB::beginTransaction();
        try {
            $insertRows = [];
            foreach (array_slice($rows, 1) as $row) {
                if ($this->rowIsEmpty($row)) {
                    continue;
                }

                $payload = [
                    'upload_id' => $upload->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                foreach (self::HEADER_MAP as $sourceHeader => $targetColumn) {
                    $value = null;
                    if (array_key_exists($sourceHeader, $headerIndexMap)) {
                        $value = $row[$headerIndexMap[$sourceHeader]];
                    }
                    $payload[$targetColumn] = $this->transformValue($targetColumn, $value);
                }

                if ($this->shouldSkipZeroCampaignRow($payload)) {
                    continue;
                }

                $insertRows[] = $payload;
            }

            if (!empty($insertRows)) {
                foreach (array_chunk($insertRows, 500) as $chunk) {
                    FbAdsMetric::insert($chunk);
                }
            }

            $upload->rows_imported = count($insertRows);
            $upload->save();

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Upload failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.metrics.index')->with('success', 'File uploaded and imported successfully.');
    }

    public function destroy($id)
    {
        $upload = FbAdsMetricUpload::findOrFail($id);

        DB::beginTransaction();
        try {
            FbAdsMetric::where('upload_id', $upload->id)->delete();
            $upload->delete();
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Delete failed: ' . $e->getMessage());
        }

        return redirect()->route('fbads.metrics.index')->with('success', 'Upload entry deleted.');
    }

    public function updateExportedDate(Request $request, $id)
    {
        $request->validate([
            'exported_date' => 'required|date',
        ]);

        $upload = FbAdsMetricUpload::findOrFail($id);
        $upload->exported_date = $request->input('exported_date');
        $upload->save();

        return redirect()->route('fbads.metrics.index')->with('success', 'Exported date updated.');
    }

    private function rowIsEmpty(array $row)
    {
        foreach ($row as $value) {
            if ($value !== null && trim((string) $value) !== '') {
                return false;
            }
        }
        return true;
    }

    private function transformValue($column, $value)
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        if (in_array($column, ['reporting_starts', 'reporting_ends', 'date_created', 'date_last_edited'], true)) {
            return $this->toDate($value);
        }

        $numericColumns = [
            'amount_spent_php', 'reach', 'impressions', 'frequency', 'cpm_php', 'clicks_all', 'ctr_all',
            'cpc_all_php', 'link_clicks', 'ctr_link_click_through_rate', 'cpc_cost_per_link_click_php',
            'landing_page_views', 'cost_per_landing_page_view_php', 'landing_page_views_rate_per_link_clicks',
            'content_views', 'content_views_conversion_value', 'adds_to_cart', 'cost_per_add_to_cart_php',
            'initiate_check_out_rate', 'purchases', 'cost_per_purchase_php', 'purchases_conversion_value',
            'purchase_roas_return_on_ad_spend', 'three_second_video_plays',
            'three_second_video_plays_rate_per_impressions', 'cost_per_three_second_video_play_php', 'thruplays',
            'cost_per_thruplay_php', 'video_plays_at_25', 'video_plays_at_50', 'video_plays_at_95',
            'video_plays_at_75', 'video_plays_at_100', 'video_plays', 'video_average_play_time',
            'post_engagements', 'cost_per_post_engagement_php', 'post_reactions', 'post_comments', 'post_saves',
            'post_shares', 'hook_rate',
        ];

        if (in_array($column, $numericColumns, true)) {
            return $this->toNumber($value);
        }

        return trim((string) $value);
    }

    private function toDate($value)
    {
        if (is_numeric($value)) {
            try {
                return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
            } catch (\Throwable $e) {
                return null;
            }
        }

        try {
            return date('Y-m-d', strtotime((string) $value));
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function toNumber($value)
    {
        if (is_numeric($value)) {
            return $value + 0;
        }

        $cleaned = str_replace([',', '₱', '%', 'x', '×', ' '], '', (string) $value);
        if ($cleaned === '' || !is_numeric($cleaned)) {
            return null;
        }
        return $cleaned + 0;
    }

    private function shouldSkipZeroCampaignRow(array $payload)
    {
        $campaignName = trim((string) ($payload['campaign_name'] ?? ''));
        if ($campaignName === '') {
            return false;
        }

        $keys = [
            'purchases',
            'cost_per_purchase_php',
            'purchase_roas_return_on_ad_spend',
            'amount_spent_php',
            'purchases_conversion_value',
        ];

        foreach ($keys as $key) {
            $val = isset($payload[$key]) ? (float) $payload[$key] : 0.0;
            if ($val != 0.0) {
                return false;
            }
        }

        return true;
    }
}
