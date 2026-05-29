<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBatchCodeToInventoryMovementsTable extends Migration
{
    public function up()
    {
        Schema::table('inventory_movements', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_movements', 'batch_code')) {
                $table->string('batch_code', 50)->nullable()->after('id');
                $table->index('batch_code');
            }
        });
    }

    public function down()
    {
        Schema::table('inventory_movements', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_movements', 'batch_code')) {
                $table->dropIndex(['batch_code']);
                $table->dropColumn('batch_code');
            }
        });
    }
}
