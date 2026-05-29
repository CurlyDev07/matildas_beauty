<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class DefaultInventoryItemsSellingPriceToZero extends Migration
{
    public function up()
    {
        DB::table('inventory_items')->whereNull('selling_price')->update(['selling_price' => 0]);
        DB::statement('ALTER TABLE inventory_items MODIFY selling_price DECIMAL(12,2) NOT NULL DEFAULT 0.00');
    }

    public function down()
    {
        DB::statement('ALTER TABLE inventory_items MODIFY selling_price DECIMAL(12,2) NULL');
    }
}
