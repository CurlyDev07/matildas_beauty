<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddStockEffectToInventoryMovementTypesTable extends Migration
{
    public function up()
    {
        Schema::table('inventory_movement_types', function (Blueprint $table) {
            if (!Schema::hasColumn('inventory_movement_types', 'stock_effect')) {
                $table->string('stock_effect', 30)->default('none')->after('slug');
            }
        });

        $effects = [
            'purchase_in' => 'add',
            'production_in' => 'add',
            'return_in' => 'add',
            'adjustment_in' => 'add',
            'sales_out' => 'subtract',
            'damage_out' => 'subtract',
            'expired_out' => 'subtract',
            'adjustment_out' => 'subtract',
            'reservation' => 'transfer',
            'release_reservation' => 'transfer',
            'status_transfer' => 'transfer',
        ];

        foreach ($effects as $slug => $effect) {
            DB::table('inventory_movement_types')->where('slug', $slug)->update(['stock_effect' => $effect]);
        }
    }

    public function down()
    {
        Schema::table('inventory_movement_types', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_movement_types', 'stock_effect')) {
                $table->dropColumn('stock_effect');
            }
        });
    }
}
