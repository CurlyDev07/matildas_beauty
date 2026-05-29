<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagePathToInventoryItemsTable extends Migration
{
    public function up()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_items', 'image_path')) {
                $table->string('image_path')->nullable()->after('description');
            }
        });
    }

    public function down()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_items', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }
}
