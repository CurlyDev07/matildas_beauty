<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvalidNoteToIncentiveEntriesTable extends Migration
{
    public function up()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            if (!Schema::hasColumn('incentive_entries', 'invalid_note')) {
                $table->text('invalid_note')->nullable()->after('invalid');
            }
        });
    }

    public function down()
    {
        Schema::table('incentive_entries', function (Blueprint $table) {
            if (Schema::hasColumn('incentive_entries', 'invalid_note')) {
                $table->dropColumn('invalid_note');
            }
        });
    }
}
