<?php
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Product;

function uuid(){
    return Str::slug(Str::uuid(), '');
}

function percentage_discount($high, $low){
    return number_format((($high - $low) / $high) * 100);
}

function item_show_slug($slug, $id){
    return url(Str::slug($slug).'-i.'.$id);
}

function admin_parent_nav(){
    return explode('/', url()->current())[4];
}

function is_matched_return_class($current_nav_url, $req_nav_name, $return_class){
    if (strtolower($current_nav_url) == strtolower($req_nav_name)) {
        return $return_class;
    }
    return false;
}

function pagination($total_count_of_result, $no_of_records_per_page, $request_page_number){
    $total_pages = ceil($total_count_of_result / $no_of_records_per_page);
    $htm = '';

    // STYLE
    $htm .= '<style>
                .page-link-indicator{
                    position: relative;
                    display: block;
                    padding: .5rem .75rem;
                    margin-left: -1px;
                    line-height: 1.25;
                    color: #4e73df;
                    background-color: #fff;
                    border: 1px solid #dddfeb;
                }
            </style>';

    $htm .= '<nav aria-label="Page navigation example">';
    $htm .= '<ul class="pagination d-flex justify-content-center">';
        for ($page=0; $page < $total_pages; $page++) {

            if($total_pages < 5){
                $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($page + 1).' ">'.($page + 1).'</a></li>';
            }else{

                if ($request_page_number < $total_pages && $request_page_number <= 4 && $total_pages > 4) {
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."1".' ">'."1".'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."2".' ">'."2".'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."3".' ">'."3".'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."4".' ">'."4".'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."5".' ">'."5".'</a></li>';

                    if ($total_pages > 5) {
                        $htm .= '<li class="page-item"><a class="page-link-indicator"><i class="fas fa-ellipsis-h"></i></li>';
                            $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.$total_pages.' ">'.$total_pages.'</a></li>';
                    }

                    $htm .= '<li class="page-item '.((($request_page_number + 1) > ($total_pages)) ? 'disabled' : ($request_page_number + 1)).' "><a class="page-link-indicator nxt" href="/'.request()->property_type.'?page='.(((intval($request_page_number) + 1) > $total_pages) ? $total_pages : ($request_page_number + 1)).'"><i class="fas fa-angle-right fa-lg"></i></a></li>';

                    break;
                }elseif($request_page_number < $total_pages && $request_page_number <= ($total_pages - 4) && $total_pages < 4){

                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -5).' ">'.($total_pages -5).'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -4).' ">'.($total_pages -4).'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -3).' ">'.($total_pages -3).'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -2).' ">'.($total_pages -2).'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages - 1).' ">'.($total_pages - 1).'</a></li>';
                    $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages).' ">'.($total_pages).'</a></li>';
                    $htm .= '<li class="page-item '.((($request_page_number - 1) < 5) ? 'disabled' : ($request_page_number - 1)).'"><a class="page-link-indicator prev" href="/'.request()->property_type.'?page='.((($request_page_number - 1) < 1) ? 1 : ($request_page_number - 1)).'"><i class="fas fa-angle-left"></i></a></li>';
                }else{
                    if ($request_page_number >= ($total_pages - 3)) {
                        $htm .= '<li class="page-item '.((($request_page_number - 1) < 5) ? 'disabled' : ($request_page_number - 1)).'"><a class="page-link-indicator prev" href="/'.request()->property_type.'?page='.((($request_page_number - 1) < 1) ? 1 : ($request_page_number - 1)).'"><i class="fas fa-angle-left"></i></a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -4).' ">'.($total_pages -4).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -3).' ">'.($total_pages -3).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -2).' ">'.($total_pages -2).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages -1).' ">'.($total_pages -1).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($total_pages).' ">'.($total_pages).'</a></li>';

                    }else{
                        $htm .= '<li class="page-item '.((($request_page_number - 1) < 4) ? 'disabled' : ($request_page_number - 1)).'"><a class="page-link-indicator prev" href="/'.request()->property_type.'?page='.((($request_page_number - 1) < 1) ? 1 : ($request_page_number - 1)).'"><i class="fas fa-angle-left"></i></a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='."1".' ">'."1".'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link-indicator"><i class="fas fa-ellipsis-h"></i></li>';

                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($request_page_number - 2).' ">'.($request_page_number - 2).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($request_page_number - 1).' ">'.($request_page_number - 1).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($request_page_number).' ">'.($request_page_number).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($request_page_number + 1).' ">'.($request_page_number + 1).'</a></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.($request_page_number + 2).' ">'.($request_page_number + 2).'</a></li>';

                        $htm .= '<li class="page-item"><a class="page-link-indicator"><i class="fas fa-ellipsis-h"></i></li>';
                        $htm .= '<li class="page-item"><a class="page-link" href="/'.request()->property_type.'?page='.$total_pages.' ">'.$total_pages.'</a></li>';
                        $htm .= '<li class="page-item '.((($request_page_number + 1) < 5) ? 'disabled' : ($request_page_number + 1)).'"><a class="page-link-indicator nxt" href="/'.request()->property_type.'?page='.((($request_page_number + 1) < 1) ? 1 : ($request_page_number + 1)).'"><i class="fas fa-angle-right"></i></a></li>';
                    }
                    break;
                }

            }
        }

    $htm .= '</ul>';
    $htm .= '</nav>';

    $htm .= '<script>';
        // **********************************
        // Change color of the current page link
        // **********************************
        $htm .= "var page_links = document.getElementsByClassName('page-link');";
        $htm .= "Array.prototype.forEach.call(page_links, function (ele) {";
            $htm .= "if(ele.innerHTML == {$request_page_number}){";
                $htm .= "ele.style.backgroundColor = '#50bf73';";
                $htm .= "ele.style.color = '#ffffff';";
            $htm .= "}";
        $htm .= "});";

        $htm .= "
                $(document).on('click', '.nxt', function(e){
                    e.preventDefault();
                    var page = (new URL(location.href)).searchParams.get('page');
                    var current_url = window.location.href;//get the current url
                    var url = new URL(current_url);
                    var query_string = url.search;
                    var search_params = new URLSearchParams(query_string);
                    var new_url = '';

                    search_params.set('page', (parseInt(page)+1));
                    url.search = search_params.toString();
                    new_url = url.toString();

                    window.location.href = new_url;
                });

                $(document).on('click', '.prev', function(e){
                    e.preventDefault();
                    var page = (new URL(location.href)).searchParams.get('page');
                    var current_url = window.location.href;//get the current url
                    var url = new URL(current_url);
                    var query_string = url.search;
                    var search_params = new URLSearchParams(query_string);
                    var new_url = '';

                    search_params.set('page', (page-1));
                    url.search = search_params.toString();
                    new_url = url.toString();

                    window.location.href = new_url;
                });

                $(document).on('click', '.page-link', function(e){
                    e.preventDefault();
                    var page = parseInt(this.innerHTML);
                    var current_url = window.location.href;//get the current url
                    var url = new URL(current_url);
                    var query_string = url.search;
                    var search_params = new URLSearchParams(query_string);
                    var new_url = '';

                    search_params.set('page', page);
                    url.search = search_params.toString();
                    new_url = url.toString();

                    window.location.href = new_url;
                });
            ";
    $htm .= '</script>';

    return $htm;
}

function add_leading_zero($param){
    if(substr(auth()->user()->mobile_number, 0, 1) != 0){
        return '0'.$param;
    }
    return $param;
}

function alt_user_image(){
    return asset('image/default-host-avatar.png');
}

function image_not_found(){
    return asset('image/image_not_found.jpg');
}

function curl_req($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
};

function bb_curl_req($url, $data){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Accept: application/json",
        "Authorization: Bearer ".config('app.dayo_api_token'),
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

function page_number_handler($request_page_number){
    if (isset($request_page_number)) {
        if (is_numeric($request_page_number)) {
            return $request_page_number;
        }
    }
    return 1;
}

function cache_query($cache_key, $query, $is_dashboard=false){
    $timeInMinutes = 5;
    // $timeInMinutes = config('app.cache_time');

    if ($is_dashboard == true) {
        $timeInMinutes == 0;
    }
    return cache()->remember($cache_key, Carbon::now()->addMinutes($timeInMinutes), function() use($query){
        return $query;
    });
}

function is_empty($params=[]){
    if ($params == null || $params == '' || !isset($params)) {
        return true;
    }
    return false;
}

function get_dates_between_two_dates($date_start, $date_end){
    $result = [];
    $date_from = strtotime($date_start); // Convert date to a UNIX timestamp
    $date_to = strtotime($date_end); // Convert date to a UNIX timestamp

    // Loop from the start date to end date and output all dates inbetween
    for ($i=$date_from; $i<=$date_to; $i+=86400) {
        $result[] = date("Y-m-d", $i);
    }
    return $result;
}

function host(){
    $host_check = DB::table('hosts')->where('user_id', auth()->user()->id)->get()[0];
    return $host_check;
}

function full_current_url(){
    $https = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $req_url = $_SERVER['REQUEST_URI'];
    return $https.$host.$req_url;
}

function token_generator($output_string_count) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $output_string_count; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

function date_f($date, $date_string_format){
    return date($date_string_format, strtotime($date));
}

function singular_plural($value, $message){
    return ($value > 1) ? $value.' '.$message.'s' : $value .' '.$message ; 
}

function inclusive($price, $percent){
    return $price * ($percent /100);
}

function rm_schars($string){
   return preg_replace("/[^A-Za-z]/", " ", $string);
}

// ****************************************
// FOR TAILWIN AND MATERIALIZE CSS 
// NUMBER SPINNER
// ****************************************
function number_spinner_markup($args = []){
    $value = isset($args['value']) ? $args['value']: '1';
    $class = isset($args['class']) ? $args['class']: '';

    return ('
            <style>
                input::-webkit-outer-spin-button,
                input::-webkit-inner-spin-button {
                    /* display: none; <- Crashes Chrome on hover */
                    -webkit-appearance: none;
                    margin: 0;
                }
            </style>

            <div class="tflex">
                <a class="btn tbg-primary hover:tbg-primary waves-effect waves-light qty_min tflex titems-center" style="height:44px;">
                    <i class="fas fa-minus" style="font-size: 12px;"></i>
                </a>
                <input type="number" disabled value="'.$value.'" min="1" class="'.$class.' number_spinner  browser-default tappearance-none focus:tbg-white focus:toutline-none tappearance-none tbg-gray-200 tblock tborder tborder-gray-200 tleading-tight tpy-3 ttext-center ttext-gray-700" style="height: 45px; width: 43px;">
                <a class="btn tbg-primary hover:tbg-primary waves-effect waves-light qty_add tflex titems-center" style="height: 44px;">
                    <i class="fas fa-plus" style="font-size: 12px;"></i>
                </a>
            </div>
        ');
}// ECHO THIS MARKUP

function number_spinner_js($max = ''){
    $max = $max != '' ? $max: '99';

    return '
        <script>
            $(document).on("click", ".qty_add", function() {
                let val = parseInt($(this).prev().val());
                val++;
                if (val <= "'.$max.'"){
                    $(this).prev().val(val);
                }
            });
            $(document).on("click", ".qty_min", function() {
                let val = parseInt($(this).next().val());
                val--;

                if (val != 0) {
                    $(this).next().val(val)
                }
            });
        </script>
    ';
}// ECHO THIS SCRIPT TO FOOTER

function currency(){
    $php = ['localhost', '127.0.0.1', "shopickers.com", "192.168.1.2", "192.168.1.6", "matildasbeauty.com"];
    $domain = $_SERVER['SERVER_NAME'];
    $currency = in_array($domain, $php) ? '₱' : '$';

    return $currency;
}

function currency_text(){
    return currency() == '$' ? 'USD' : 'PHP';
}

function get_variations($arrays) {
    $result = array(array());

    foreach ($arrays as $property => $property_values) {
        $tmp = array();
        foreach ($result as $result_item) {
            foreach ($property_values as $property_value) {
                $tmp[] = array_merge($result_item, array($property => $property_value));
            }
        }
        $result = $tmp;
    }
    return $result;
}

function base64ToImage($base64_string, $path) {
    // df = directory_and_filename
    $df = $path.uuid().'.jpg';
    $file = fopen($df, "wb");
    $data = explode(',', $base64_string);
    fwrite($file, base64_decode($data[1]));
    fclose($file);
    return $df;
}

function s3_upload_image($path_and_file_name, $base64_string){
    $base64decoded = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64_string));
    // $upload_success_md = Storage::disk('s3')->put($path_and_file_name, $base64decoded); // production
    $upload_success_md = Storage::disk('public')->put($path_and_file_name, $base64decoded); // development
}

function upload_resize_product_image($image_name, $base64, $size){
    if ($size == 'small') {
        $small = Image::make($base64);
        return Storage::disk('s3')->put($image_name, $small->fit(320, 320)->save($base64));

        // $make = Image::make($base64);
        // return Storage::disk('public')->put($image_name, $make->fit(320, 320)->save($base64));
    }// crop image to 320x320px

    if ($size == 'original') {
        $original = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        return Storage::disk('s3')->put($image_name, $original);
    }// Retain original image
}



function rm_cloudfront($img){
    return str_replace(config('app.cloudfront'), "", $img);
}

function carbon($data){
    return Carbon::parse($data);
}


// SEO HELPERS

function seo_title($title=""){
    if ($title == "") {
        return "Online Shopping in the Phillipines with Great prices" ." - ".site_name();
    }
    return $title." - ".site_name();
}

function seo_image($image=""){
    if ($image == "") {
        return url("images/logo/main.png");
    }
    return $image;
}

function seo_description($description=""){
    if ($description == "") {
        return "Online Shopping in the Phillipines with Great prices and Provides High Quality Products | Fast Delivery | Cash on Delivery";
    }
    return $description;
}

function seo_robots($robots=""){
    if ($robots == "") {
        return "none";
    }
    return $robots;
}

function site_name(){
    return "shopickers.com";
}

function url_has($hasStringofParams) {
    return count(explode($hasStringofParams, url()->current())) == 2? true:false;
}

function quantity($qty){
    if ($qty == null) {
        $qty = 'Only '.lowest_stocks().' items left';// default for dropshipping
    }elseif ($qty < 20) {
        $qty = "Only {$qty} items left";// default for dropshipping
    }elseif ($qty > 20) {
        $qty = "{$qty} items available";// default for dropshipping
    }

    return $qty;
}

function lowest_stocks(){
    return rand(1, 10);
}

function generateOrderNumber($transaction_id){
    return "LX".now()->format('ymd').$transaction_id;
}

function img_url($imgurl){
    return asset('/images/products/'. $imgurl);
}

function sku_check($sku){
    $check = Product::where('sku', strtoupper($sku))->exists();

    return $check;
}


function infoTextSend($mobile, $sms){
    $sms_data = [
        'UserID' => '669',
        'ApiKey' => '207bb08817f8ab47ac813b6b8917de0d',
        'Mobile' => $mobile,
        'SMS' => $sms,
    ];
    
    curl_req('https://api.myinfotxt.com/v2/send.php', $sms_data);
}
