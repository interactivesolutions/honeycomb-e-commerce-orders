<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTaxAmountFieldsToHcOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_order_details', function (Blueprint $table) {
            $table->float('price_tax_amount', 20, 6)->nullable()->default("0.000000")->after('price_before_tax');
            $table->float('total_price_tax_amount', 20, 6)->nullable()->default("0.000000")->after('total_price_before_tax');
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
            $table->dropColumn('price_tax_amount', 'total_price_tax_amount');
        });
    }
}
