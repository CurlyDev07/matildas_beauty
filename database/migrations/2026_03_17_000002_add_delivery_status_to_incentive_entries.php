<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeliveryStatusToIncentiveEntries extends Migration
{
    public function up()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            $table->enum('delivery_status', ['shipped', 'delivered'])->nullable()->after('customer_mobile');
            $table->boolean('approved')->default(false)->after('delivery_status');
        });
    }

    public function down()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            $table->dropColumn(['delivery_status', 'approved']);
        });
    }
}
