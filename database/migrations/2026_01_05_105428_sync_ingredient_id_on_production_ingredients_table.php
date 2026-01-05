<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SyncIngredientIdOnProductionIngredientsTable extends Migration
{
    public function up()
    {
        Schema::table('production_ingredients', function (Blueprint $table) {
            if (!Schema::hasColumn('production_ingredients', 'ingredient_id')) {
                $table->unsignedBigInteger('ingredient_id')->nullable()->after('production_id');
            }
        });
    }

    public function down()
    {
        Schema::table('production_ingredients', function (Blueprint $table) {
            if (Schema::hasColumn('production_ingredients', 'ingredient_id')) {
                $table->dropColumn('ingredient_id');
            }
        });
    }
}
