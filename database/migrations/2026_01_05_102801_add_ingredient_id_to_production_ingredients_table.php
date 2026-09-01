<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIngredientIdToProductionIngredientsTable extends Migration
{
public function up()
{
    Schema::table('production_ingredients', function (Blueprint $table) {
        $table->unsignedBigInteger('ingredient_id')->nullable()->after('production_id');

        $table->foreign('ingredient_id')
            ->references('id')
            ->on('ingredients')
            ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('production_ingredients', function (Blueprint $table) {
        $table->dropForeign(['ingredient_id']);
        $table->dropColumn('ingredient_id');
    });
}
}
