<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInventoryMovementTypesTable extends Migration
{
    public function up()
    {
        Schema::create('inventory_movement_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->string('stock_effect', 30)->default('none');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });

        $now = now();
        $movementTypes = [
            ['Purchase In', 'purchase_in', 'add'],
            ['Production In', 'production_in', 'add'],
            ['Sales Out', 'sales_out', 'subtract'],
            ['Return In', 'return_in', 'add'],
            ['Damage Out', 'damage_out', 'subtract'],
            ['Expired Out', 'expired_out', 'subtract'],
            ['Adjustment In', 'adjustment_in', 'add'],
            ['Adjustment Out', 'adjustment_out', 'subtract'],
            ['Reservation', 'reservation', 'transfer'],
            ['Release Reservation', 'release_reservation', 'transfer'],
            ['Status Transfer', 'status_transfer', 'transfer'],
        ];

        foreach ($movementTypes as $movementType) {
            DB::table('inventory_movement_types')->insert([
                'name' => $movementType[0],
                'slug' => $movementType[1],
                'stock_effect' => $movementType[2],
                'description' => null,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        Schema::table('inventory_movements', function (Blueprint $table) {
            $table->unsignedBigInteger('movement_type_id')->nullable()->after('inventory_item_id');
            $table->foreign('movement_type_id')->references('id')->on('inventory_movement_types')->onDelete('set null');
        });

        DB::table('inventory_movements')
            ->join('inventory_movement_types', 'inventory_movement_types.slug', '=', 'inventory_movements.movement_type')
            ->update(['inventory_movements.movement_type_id' => DB::raw('inventory_movement_types.id')]);
    }

    public function down()
    {
        Schema::table('inventory_movements', function (Blueprint $table) {
            if (Schema::hasColumn('inventory_movements', 'movement_type_id')) {
                $table->dropForeign(['movement_type_id']);
                $table->dropColumn('movement_type_id');
            }
        });

        Schema::dropIfExists('inventory_movement_types');
    }
}
