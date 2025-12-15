<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderSourcesTable extends Migration
{
    public function up()
    {
        Schema::create('order_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->unique();
            $table->enum('type', ['website', 'social', 'sms', 'call', 'event', 'referral', 'other'])->default('other');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('color', 7)->nullable()->comment('Hex color code');
            $table->timestamps();
            
            $table->index('type');
            $table->index('is_active');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_sources');
    }
}