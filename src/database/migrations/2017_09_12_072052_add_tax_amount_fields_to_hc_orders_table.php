<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxAmountFieldsToHcOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_orders', function (Blueprint $table) {
            $table->float('total_price_tax_amount', 20, 6)->nullable()->default("0.000000")->after('total_price_before_tax');
            $table->float('total_discounts_tax_amount', 20, 6)->nullable()->default("0.000000")->after('total_discounts_before_tax');
            $table->float('total_paid_tax_amount', 20, 6)->nullable()->default("0.000000")->after('total_paid_before_tax');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_orders', function (Blueprint $table) {
            $table->dropColumn('total_price_tax_amount', 'total_discounts_tax_amount', 'total_paid_tax_amount');
        });
    }
}
