<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingStockOutItemsTable extends Migration
{
    public function up()
    {
        Schema::create('packaging_stock_out_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('stock_out_id')->index();
            $table->unsignedBigInteger('packaging_material_id')->index();
            $table->decimal('quantity', 14, 4);
            $table->timestamps();

            $table->foreign('stock_out_id')->references('id')->on('packaging_stock_outs')->onDelete('cascade');
            $table->foreign('packaging_material_id')->references('id')->on('packaging_materials');
        });
    }

    public function down()
    {
        Schema::dropIfExists('packaging_stock_out_items');
    }
}
