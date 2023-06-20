<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id');
            $table->string('status')->comment('complete/incomplete/request_a_refund/refund_complete/refund_rejected');
            $table->string('platform')->comment('shopee/tiktok/lazada');
            $table->string('store')->nullable();
            $table->string('courier')->comment('j&t/spx/lex/xde/ninjavan/gogo');
            $table->string('pouch_size')->comment('sm/md/lg/xl/xxl/nopouch');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rts');
    }
}
