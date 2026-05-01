<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJandtPayoutUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('jandt_payout_uploads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('original_file_name');
            $table->string('stored_file_name');
            $table->string('file_path');
            $table->unsignedInteger('uploaded_by')->nullable();
            $table->unsignedInteger('rows_imported')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jandt_payout_uploads');
    }
}

