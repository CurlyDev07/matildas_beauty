<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('inventory_categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_categories');
    }
}
