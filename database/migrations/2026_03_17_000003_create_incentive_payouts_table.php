<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncentivePayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('incentive_payouts', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string('label');
            $table->date('period_start');
            $table->date('period_end');
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->timestamp('released_at')->nullable();
            $table->unsignedBigInteger('released_by_id')->nullable();
            $table->foreign('released_by_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incentive_payouts');
    }
}
