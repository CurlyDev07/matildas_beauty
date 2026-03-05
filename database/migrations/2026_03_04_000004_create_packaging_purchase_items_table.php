<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingPurchaseItemsTable extends Migration
{
    public function up()
    {
        Schema::create('packaging_purchase_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purchase_id')->index();
            $table->unsignedBigInteger('packaging_material_id')->index();
            $table->decimal('quantity', 14, 4);
            $table->decimal('unit_cost', 12, 4);
            $table->decimal('total_cost', 14, 2);
            $table->timestamps();

            $table->foreign('purchase_id')->references('id')->on('packaging_purchases')->onDelete('cascade');
            $table->foreign('packaging_material_id')->references('id')->on('packaging_materials');
        });
    }

    public function down()
    {
        Schema::dropIfExists('packaging_purchase_items');
    }
}
