<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->integer('selling_price')->nullable();
            $table->integer('campaign_price')->nullable();
            $table->integer('price')->nullable();
            $table->integer('compare_price')->nullable()->default(0);

            $table->double('profit')->nullable()->default(0);
            $table->double('profit_percentage')->nullable()->default(0);
            
            $table->integer('qty')->nullable()->default(0);
            $table->integer('threshold')->nullable()->default(0);
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('status')->default('inactive')->comment('active|inactive|top-selling|featured');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
