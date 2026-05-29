<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMovementsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch_code', 50)->nullable()->index();
            $table->unsignedBigInteger('inventory_item_id');
            $table->unsignedBigInteger('from_status_id')->nullable();
            $table->unsignedBigInteger('to_status_id')->nullable();
            $table->string('movement_type', 100);
            $table->decimal('quantity', 14, 3);
            $table->decimal('unit_cost', 12, 2)->nullable();
            $table->string('reference_type', 100)->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('inventory_item_id')->references('id')->on('inventory_items');
            $table->foreign('from_status_id')->references('id')->on('inventory_statuses');
            $table->foreign('to_status_id')->references('id')->on('inventory_statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_movements');
    }
}
