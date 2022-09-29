<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\SoldFrom;

class CreateSoldFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sold_froms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->default('ONSITE')->comment('ONSITE | FB | LAZADA | SHOPEE | CAROUSEL');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        SoldFrom::insert([
            ['name' => 'FB', 'description' => 'Sold from facebook, groups, marketplace or organic post', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'SHOPEE', 'description' => 'Sold from shopee', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'LAZADA', 'description' => 'Sold from lazada', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'CAROUSEL', 'description' => 'Sold from carousel buy and sell', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'WEBSITE', 'description' => 'Sold from website', 'created_at' => now(), 'updated_at' => now(), ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sold_froms');
    }
}
