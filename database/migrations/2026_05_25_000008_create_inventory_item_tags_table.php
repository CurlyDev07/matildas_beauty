<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryItemTagsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_item_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('inventory_item_id');
            $table->unsignedBigInteger('inventory_tag_id');
            $table->timestamps();

            $table->unique(['inventory_item_id', 'inventory_tag_id'], 'unique_inventory_item_tag');
            $table->foreign('inventory_item_id')->references('id')->on('inventory_items')->onDelete('cascade');
            $table->foreign('inventory_tag_id')->references('id')->on('inventory_tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_item_tags');
    }
}

