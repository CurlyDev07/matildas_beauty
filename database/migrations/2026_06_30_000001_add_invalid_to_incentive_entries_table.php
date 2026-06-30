<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvalidToIncentiveEntriesTable extends Migration
{
    public function up()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            if (!Schema::hasColumn('incentive_entries', 'invalid')) {
                $table->boolean('invalid')->default(false)->after('approved');
            }
        });
    }

    public function down()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            if (Schema::hasColumn('incentive_entries', 'invalid')) {
                $table->dropColumn('invalid');
            }
        });
    }
}
