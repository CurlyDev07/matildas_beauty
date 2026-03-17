<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateIncentiveRatesTable extends Migration
{
    public function up()
    {
        Schema::create('incentive_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['Upsell', 'InfoTxt', 'Pancake', 'Events'])->unique();
            $table->decimal('rate', 8, 2)->default(0.00);
            $table->timestamps();
        });

        DB::table('incentive_rates')->insert([
            ['type' => 'Upsell',  'rate' => 20.00, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'InfoTxt', 'rate' => 50.00, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Pancake', 'rate' => 20.00, 'created_at' => now(), 'updated_at' => now()],
            ['type' => 'Events',  'rate' => 20.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('incentive_rates');
    }
}
