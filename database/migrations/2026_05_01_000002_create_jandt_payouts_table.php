<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJandtPayoutsTable extends Migration
{
    public function up()
    {
        Schema::create('jandt_payouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('upload_id')->index();

            $table->string('bill_number')->nullable();
            $table->string('billing_date_raw')->nullable();
            $table->date('billing_date_from')->nullable();
            $table->date('billing_date_to')->nullable();
            $table->string('vip_code')->nullable();
            $table->string('client_name')->nullable();
            $table->string('settlement_method')->nullable();
            $table->string('service_management')->nullable();
            $table->string('affiliated_branch')->nullable();
            $table->string('cod_settlement_category')->nullable();
            $table->string('cod_flag')->nullable();
            $table->string('opening_bank')->nullable();
            $table->string('bank_account')->nullable();
            $table->string('payee')->nullable();

            $table->decimal('cod_accumulated_amount', 15, 2)->nullable();
            $table->decimal('cod_total_amount', 15, 2)->nullable();
            $table->decimal('cod_amount_cwt', 15, 2)->nullable();
            $table->decimal('cod_commission_rate', 10, 4)->nullable();
            $table->decimal('cod_commission', 15, 2)->nullable();
            $table->decimal('cod_commission_vat_fee', 15, 2)->nullable();
            $table->decimal('codcwt', 15, 2)->nullable();
            $table->decimal('total_cod_payable', 15, 2)->nullable();
            $table->decimal('total_freight_receivable', 15, 2)->nullable();
            $table->decimal('settled_shipping_fee', 15, 2)->nullable();
            $table->decimal('shipping_fee_cwt', 15, 2)->nullable();
            $table->decimal('return_shipping', 15, 2)->nullable();
            $table->decimal('return_cwt', 15, 2)->nullable();
            $table->decimal('super_value_added_fee', 15, 2)->nullable();
            $table->decimal('return_freight_policy_adjustment', 15, 2)->nullable();
            $table->decimal('cod_amount_adjustment', 15, 2)->nullable();
            $table->decimal('cod_commission_adjustment', 15, 2)->nullable();
            $table->decimal('cod_vat_adjustment', 15, 2)->nullable();
            $table->decimal('codcwt_adjustment', 15, 2)->nullable();
            $table->decimal('total_shipping_fee_adjustment', 15, 2)->nullable();
            $table->decimal('total_shipping_fee_cwt_adjustment', 15, 2)->nullable();
            $table->decimal('rts_shipping_fee_adjustment', 15, 2)->nullable();
            $table->decimal('rts_total_shipping_fee_cwt_adjustment', 15, 2)->nullable();
            $table->decimal('other_adjustment', 15, 2)->nullable();
            $table->decimal('discount_amount', 15, 2)->nullable();
            $table->decimal('total_adjustment', 15, 2)->nullable();
            $table->decimal('payment_amount', 15, 2)->nullable();
            $table->decimal('previous_period_bill_deduction', 15, 2)->nullable();
            $table->decimal('amount_after_deduction', 15, 2)->nullable();
            $table->decimal('current_period_bill_deduction', 15, 2)->nullable();
            $table->decimal('already_deducted_freight_bill', 15, 2)->nullable();
            $table->decimal('shipping_fee_difference', 15, 2)->nullable();

            $table->dateTime('creation_time')->nullable();
            $table->string('confirm_status')->nullable();
            $table->dateTime('confirm_time')->nullable();
            $table->string('billing_status')->nullable();
            $table->string('email_sending_status')->nullable();
            $table->dateTime('email_sending_time')->nullable();

            $table->json('raw_payload')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jandt_payouts');
    }
}

