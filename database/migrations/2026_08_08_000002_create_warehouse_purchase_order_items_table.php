<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousePurchaseOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_purchase_order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('warehouse_purchase_order_id');
            $table->unsignedBigInteger('inventory_item_id');
            $table->string('item_name', 255);
            $table->string('sku', 100)->nullable();
            $table->decimal('avg_daily_orders', 14, 3)->default(0);
            $table->decimal('quantity', 14, 3)->default(0);
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('line_total', 14, 2)->default(0);
            $table->timestamps();

            $table->foreign('warehouse_purchase_order_id', 'wpo_items_order_fk')
                ->references('id')
                ->on('warehouse_purchase_orders')
                ->onDelete('cascade');
            $table->foreign('inventory_item_id', 'wpo_items_inventory_item_fk')
                ->references('id')
                ->on('inventory_items');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouse_purchase_order_items');
    }
}
