<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAttemptTrackingToOrderSignalBlockListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_signal_block_lists', function (Blueprint $table) {
            $table->unsignedInteger('attempt_count')->default(0)->after('fingerprintjs_visitor_id');
            $table->bigInteger('last_attempt_at')->nullable()->after('attempt_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_signal_block_lists', function (Blueprint $table) {
            $table->dropColumn(['attempt_count', 'last_attempt_at']);
        });
    }
}

