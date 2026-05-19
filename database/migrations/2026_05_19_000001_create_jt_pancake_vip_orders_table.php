<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJtPancakeVipOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jt_pancake_vip_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tracking_number')->nullable()->index();
            $table->string('phone_number')->nullable()->index();
            $table->string('customer');
            $table->text('product_list')->nullable();
            $table->enum('workflow_stage', ['sales', 'production', 'packing', 'handover', 'shipped'])->default('sales')->index();
            $table->enum('status', ['active', 'on_hold', 'cancelled', 'completed'])->default('active')->index();
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
        Schema::dropIfExists('jt_pancake_vip_orders');
    }
}

