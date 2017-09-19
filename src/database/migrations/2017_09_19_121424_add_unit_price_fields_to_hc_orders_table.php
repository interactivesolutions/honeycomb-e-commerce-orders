<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnitPriceFieldsToHcOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_orders', function (Blueprint $table) {
            $table->float('total_unit_price', 20, 6)->nullable()->default(0.000000);
            $table->float('total_unit_price_before_tax', 20, 6)->nullable()->default(0.000000);
            $table->float('total_unit_price_tax_amount', 20, 6)->nullable()->default(0.000000);
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
            $table->dropColumn('total_unit_price', 'total_unit_price_before_tax', 'total_unit_price_tax_amount');
        });
    }
}
