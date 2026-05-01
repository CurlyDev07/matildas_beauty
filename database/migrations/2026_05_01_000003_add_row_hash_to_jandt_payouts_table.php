<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRowHashToJandtPayoutsTable extends Migration
{
    public function up()
    {
        Schema::table('jandt_payouts', function (Blueprint $table) {
            $table->string('row_hash', 64)->nullable()->after('upload_id');
            $table->unique('row_hash', 'jandt_payouts_row_hash_unique');
        });
    }

    public function down()
    {
        Schema::table('jandt_payouts', function (Blueprint $table) {
            $table->dropUnique('jandt_payouts_row_hash_unique');
            $table->dropColumn('row_hash');
        });
    }
}

