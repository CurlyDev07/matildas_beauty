<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingStockOutsTable extends Migration
{
    public function up()
    {
        Schema::create('packaging_stock_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference')->nullable();
            $table->string('notes')->nullable();
            $table->date('date')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packaging_stock_outs');
    }
}
