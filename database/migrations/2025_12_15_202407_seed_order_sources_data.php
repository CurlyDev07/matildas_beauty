<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedOrderSourcesData extends Migration
{
    public function up()
    {
        $sources = [
            // Websites
            ['name' => 'MissTisa Serum Website', 'type' => 'website', 'description' => 'misstisa-serum.com', 'color' => '#10b981'],
            ['name' => 'MissTisa Lotion Website', 'type' => 'website', 'description' => 'misstisa-lotion.com', 'color' => '#3b82f6'],
            ['name' => 'MissTisa Set Website', 'type' => 'website', 'description' => 'misstisa-set.com', 'color' => '#ec4899'],
            
            // SMS
            ['name' => 'InfoText - Repeat Order', 'type' => 'sms', 'description' => 'Customer texted to order again', 'color' => '#f59e0b'],
            ['name' => 'InfoText - New Order', 'type' => 'sms', 'description' => 'New customer via SMS', 'color' => '#f59e0b'],
            
            // Calls
            ['name' => 'Warm Call', 'type' => 'call', 'description' => 'Follow-up call, offered bundle', 'color' => '#8b5cf6'],
            ['name' => 'Cold Call', 'type' => 'call', 'description' => 'Outbound call to new lead', 'color' => '#8b5cf6'],
            
            // Events
            ['name' => 'Abandoned Cart Follow-up', 'type' => 'event', 'description' => 'Customer started but didn\'t complete order', 'color' => '#ef4444'],
            ['name' => 'Lead Magnet Follow-up', 'type' => 'event', 'description' => 'Downloaded freebie, followed up', 'color' => '#ef4444'],
            
            // Social
            ['name' => 'Facebook Messenger', 'type' => 'social', 'description' => 'Direct message on Facebook', 'color' => '#1877f2'],
            ['name' => 'Instagram DM', 'type' => 'social', 'description' => 'Direct message on Instagram', 'color' => '#e4405f'],
            
            // Referral
            ['name' => 'Customer Referral', 'type' => 'referral', 'description' => 'Referred by existing customer', 'color' => '#059669'],
            
            // Other
            ['name' => 'Walk-in', 'type' => 'other', 'description' => 'Physical visit', 'color' => '#6b7280'],
            ['name' => 'Email Inquiry', 'type' => 'other', 'description' => 'Customer emailed us', 'color' => '#6b7280'],
        ];

        foreach ($sources as $source) {
            DB::table('order_sources')->insert(array_merge($source, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }
    }

    public function down()
    {
        DB::table('order_sources')->truncate();
    }
}