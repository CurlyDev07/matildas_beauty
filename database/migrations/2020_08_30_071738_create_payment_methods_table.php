<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\PaymentMethod;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index()->default('BANK TRANSFER')->comment('BANK TRANSFER | COD | GCASH | MEETUP | UPFRONT');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        PaymentMethod::insert([
            ['name' => 'COD', 'description' => 'Paid via cash on delivery', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'BANK TRANSFER', 'description' => 'Paid via bank transfer', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'GCASH', 'description' => 'Paid via gcash', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'MEETUP', 'description' => 'Paid via meetup', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'PICKUP', 'description' => 'Paid via pickup', 'created_at' => now(), 'updated_at' => now(), ],
            ['name' => 'PAYPAL', 'description' => 'Paid via paypal', 'created_at' => now(), 'updated_at' => now(), ],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_methods');
    }
}
