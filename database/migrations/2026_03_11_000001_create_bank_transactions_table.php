<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bank');
            $table->string('platform_type')->default('bank');
            $table->string('transaction_type');
            $table->decimal('amount', 12, 2);
            $table->string('currency', 10)->default('PHP');
            $table->string('reference_number')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_account')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('confidence_score', 4, 2)->nullable();
            $table->string('receipt_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bank_transactions');
    }
}
