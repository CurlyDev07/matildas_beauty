<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMovementAuditsTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_movement_audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch_code', 50)->index();
            $table->string('action', 50);
            $table->text('summary')->nullable();
            $table->json('before_snapshot')->nullable();
            $table->json('after_snapshot')->nullable();
            $table->text('error_message')->nullable();
            $table->unsignedBigInteger('performed_by')->nullable()->index();
            $table->timestamps();

            $table->foreign('performed_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inventory_movement_audits');
    }
}
