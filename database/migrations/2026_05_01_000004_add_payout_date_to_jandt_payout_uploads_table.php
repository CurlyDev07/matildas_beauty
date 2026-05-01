<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPayoutDateToJandtPayoutUploadsTable extends Migration
{
    public function up()
    {
        Schema::table('jandt_payout_uploads', function (Blueprint $table) {
            $table->date('payout_date')->nullable()->after('file_path');
        });
    }

    public function down()
    {
        Schema::table('jandt_payout_uploads', function (Blueprint $table) {
            $table->dropColumn('payout_date');
        });
    }
}

