<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitPriceAndDiscountFieldsToHcOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_order_details', function (Blueprint $table) {
            $table->float('unit_price', 20, 6)->nullable()->default(0.000000);
            $table->float('unit_price_before_tax', 20, 6)->nullable()->default(0.000000);
            $table->float('unit_price_tax_amount', 20, 6)->nullable()->default(0.000000);

            $table->string('discount_type')->nullable()->default(0.000000);
            $table->string('discount_amount')->nullable()->default(0.000000);

            $table->float('discounts', 20, 6)->nullable()->default(0.000000);
            $table->float('discounts_before_tax', 20, 6)->nullable()->default(0.000000);
            $table->float('discounts_tax_amount', 20, 6)->nullable()->default(0.000000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_order_details', function (Blueprint $table) {
            $table->dropColumn(
                'unit_price',
                'unit_price_before_tax',
                'unit_price_tax_amount',
                'discount_type',
                'discount_amount',
                'discounts',
                'discounts_before_tax',
                'discounts_tax_amount'
            );
        });
    }
}
