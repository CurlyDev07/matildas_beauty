<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateWarehouseInventoryItemStructure extends Migration
{
    public function up()
    {
        Schema::table('inventory_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_categories', 'parent_id')) {
                $table->unsignedBigInteger('parent_id')->nullable()->after('id');
                $table->foreign('parent_id')->references('id')->on('inventory_categories')->onDelete('set null');
            }
        });

        Schema::table('inventory_items', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_items', 'item_type_id')) {
                $table->dropForeign(['item_type_id']);
                $table->dropColumn('item_type_id');
            }
            if (Schema::hasColumn('inventory_items', 'group_id')) {
                $table->dropForeign(['group_id']);
                $table->dropColumn('group_id');
            }
            if (Schema::hasColumn('inventory_items', 'average_cost')) {
                $table->dropColumn('average_cost');
            }
        });
    }

    public function down()
    {
        Schema::table('inventory_items', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_items', 'item_type_id')) {
                $table->unsignedBigInteger('item_type_id')->nullable()->after('id');
            }
            if (!Schema::hasColumn('inventory_items', 'group_id')) {
                $table->unsignedBigInteger('group_id')->nullable()->after('category_id');
            }
            if (!Schema::hasColumn('inventory_items', 'average_cost')) {
                $table->decimal('average_cost', 12, 2)->default(0)->after('cost');
            }
        });

        Schema::table('inventory_items', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_items', 'item_type_id')) {
                $table->foreign('item_type_id')->references('id')->on('inventory_item_types');
            }
            if (Schema::hasColumn('inventory_items', 'group_id')) {
                $table->foreign('group_id')->references('id')->on('inventory_groups');
            }
        });

        Schema::table('inventory_categories', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_categories', 'parent_id')) {
                $table->dropForeign(['parent_id']);
                $table->dropColumn('parent_id');
            }
        });
    }
}
