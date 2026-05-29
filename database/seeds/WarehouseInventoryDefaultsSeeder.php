<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WarehouseInventoryDefaultsSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        $units = [
            ['Pieces', 'pcs'], ['Box', 'box'], ['Set', 'set'], ['Kilogram', 'kg'], ['Gram', 'g'],
            ['Liter', 'L'], ['Milliliter', 'ml'], ['Roll', 'roll'], ['Pack', 'pack'], ['Bottle', 'bottle'], ['Sachet', 'sachet'],
        ];
        foreach ($units as $u) {
            DB::table('inventory_units')->updateOrInsert(
                ['short_name' => $u[1]],
                ['name' => $u[0], 'is_active' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }

        $statuses = ['Available', 'Reserved', 'Damaged', 'Expired', 'Returned', 'For Checking', 'In Transit'];
        foreach ($statuses as $name) {
            DB::table('inventory_statuses')->updateOrInsert(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'is_active' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }

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
            DB::table('inventory_movement_types')->updateOrInsert(
                ['slug' => $movementType[1]],
                ['name' => $movementType[0], 'stock_effect' => $movementType[2], 'description' => null, 'is_active' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }

        $categories = ['Finished Products', 'Ingredients', 'Packaging Materials', 'Shipping Supplies', 'Promo Items', 'Office Supplies'];
        foreach ($categories as $name) {
            DB::table('inventory_categories')->updateOrInsert(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'parent_id' => null, 'description' => null, 'is_active' => 1, 'updated_at' => $now, 'created_at' => $now]
            );
        }
    }
}
