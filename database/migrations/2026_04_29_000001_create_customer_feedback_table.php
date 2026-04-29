<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('customer_feedback', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source', 100)->nullable();
            $table->text('message')->nullable();
            $table->string('type', 100)->nullable();
            $table->string('sentiment', 100)->nullable();
            $table->string('category', 100)->nullable();
            $table->text('summary')->nullable();
            $table->text('recommended_action')->nullable();
            $table->boolean('is_usable_as_testimonial')->default(false);
            $table->string('risk_level', 100)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customer_feedback');
    }
}
