<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("order_id")->index();
            $table->string("store")->index();
            $table->string("order_status")->default();
            $table->string("cancel_reason");
            $table->string("return_refund_status");
            $table->string("tracking_number");
            $table->string("shipping_option");
            $table->string("shipment_method");
            $table->dateTime("estimated_ship_out_date");
            $table->dateTime("ship_time");
            $table->dateTime("order_creation_date");
            $table->dateTime("order_paid_time");
            $table->string("parent_sku_reference_no");
            $table->string("product_name");
            $table->string("sku_reference_no");
            $table->string("variation_name");
            $table->string("original_price");
            $table->string("deal_price");
            $table->string("quantity");
            $table->string("product_subtotal");
            $table->string("total_discount");
            $table->string("price_discount_from_seller");
            $table->string("shopee_rebate");
            $table->string("sku_total_weight");
            $table->string("number_of_items_in_order");
            $table->string("order_total_weight");
            $table->string("seller_voucher");
            $table->string("seller_absorbed_coin_cashback");
            $table->string("shopee_voucher");
            $table->string("bundle_deals_indicator");
            $table->string("shopee_bundle_discount");
            $table->string("seller_bundle_discount");
            $table->string("shopee_coins_offset");
            $table->string("credit_card_discount_total");
            $table->string("products_price_paid_by_buyer");
            $table->string("buyer_paid_shipping_fee");
            $table->string("shipping_rebate_estimate");
            $table->string("reverse_shipping_fee");
            $table->string("service_fee");
            $table->string("grand_total");
            $table->string("estimated_shipping_fee");
            $table->string("username_buyer");
            $table->string("receiver_name");
            $table->string("phone_number");
            $table->string("delivery_address");
            $table->string("town");
            $table->string("district");
            $table->string("province");
            $table->string("region");
            $table->string("country");
            $table->string("zip_code");
            $table->longText("remark_from_buyer");
            $table->dateTime("order_complete_time");
            $table->string("note");
            $table->string("original_file_name");
            $table->integer("profit")->default(0);
            $table->boolean("is_seller_voucher_fix")->default(false);
            $table->integer("transaction_fee");
            $table->integer("comission_fee");
            $table->integer("power_up")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopees');
    }
}
