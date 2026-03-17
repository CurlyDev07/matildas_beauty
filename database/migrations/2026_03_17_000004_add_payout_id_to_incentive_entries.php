<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutIdToIncentiveEntries extends Migration
{
    public function up()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            $table->unsignedBigInteger('payout_id')->nullable()->after('approved');
            $table->foreign('payout_id')->references('id')->on('incentive_payouts');
        });
    }

    public function down()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            $table->dropForeign(['payout_id']);
            $table->dropColumn('payout_id');
        });
    }
}
