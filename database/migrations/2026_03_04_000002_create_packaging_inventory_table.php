<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingInventoryTable extends Migration
{
    public function up()
    {
        Schema::create('packaging_inventory', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('packaging_material_id')->index();
            $table->decimal('quantity', 14, 4)->default(0);
            $table->timestamps();

            $table->unique('packaging_material_id');
            $table->foreign('packaging_material_id')->references('id')->on('packaging_materials')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('packaging_inventory');
    }
}
