<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehouseInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_item_id');
            $table->unsignedBigInteger('inventory_status_id');
            $table->decimal('quantity', 14, 3)->default(0);
            $table->decimal('reorder_level', 14, 3)->default(0);
            $table->timestamps();

            $table->unique(['inventory_item_id', 'inventory_status_id'], 'unique_inventory_balance');
            $table->foreign('inventory_item_id')->references('id')->on('inventory_items');
            $table->foreign('inventory_status_id')->references('id')->on('inventory_statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouse_inventory');
    }
}

