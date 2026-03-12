<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToBankTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('bank_transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
