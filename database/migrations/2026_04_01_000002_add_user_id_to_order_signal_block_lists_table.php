<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToOrderSignalBlockListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_signal_block_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id')->index();
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
            $table->dropColumn('user_id');
        });
    }
}
