<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->string('sku', 100)->unique()->nullable();
            $table->string('barcode', 100)->unique()->nullable();
            $table->string('name', 255);
            $table->decimal('cost', 12, 2)->default(0);
            $table->decimal('selling_price', 12, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('inventory_categories');
            $table->foreign('unit_id')->references('id')->on('inventory_units');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_items');
    }
}
