<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusColumnsFromInventoryMovementsTable extends Migration
{
    public function up()
    {
        Schema::table('inventory_movements', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_movements', 'from_status_id')) {
                $table->dropForeign(['from_status_id']);
                $table->dropColumn('from_status_id');
            }
            if (Schema::hasColumn('inventory_movements', 'to_status_id')) {
                $table->dropForeign(['to_status_id']);
                $table->dropColumn('to_status_id');
            }
        });
    }

    public function down()
    {
        Schema::table('inventory_movements', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_movements', 'from_status_id')) {
                $table->unsignedBigInteger('from_status_id')->nullable()->after('inventory_item_id');
                $table->foreign('from_status_id')->references('id')->on('inventory_statuses');
            }
            if (!Schema::hasColumn('inventory_movements', 'to_status_id')) {
                $table->unsignedBigInteger('to_status_id')->nullable()->after('from_status_id');
                $table->foreign('to_status_id')->references('id')->on('inventory_statuses');
            }
        });
    }
}
