<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWarehousePurchaseOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('warehouse_purchase_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('po_number', 50)->unique();
            $table->unsignedInteger('avg_range_days')->default(14);
            $table->unsignedInteger('stock_coverage_days')->default(5);
            $table->dateTime('range_start')->nullable();
            $table->dateTime('range_end')->nullable();
            $table->decimal('total_amount', 14, 2)->default(0);
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('warehouse_purchase_orders');
    }
}
