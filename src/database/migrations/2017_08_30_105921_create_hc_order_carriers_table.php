<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcOrderCarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_order_carriers', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_id', 36);
            $table->string('carrier_id', 36);
            $table->string('name')->nullable();
            $table->float('weight', 20, 8)->nullable()->default('0.000000');
            $table->float('shipping_price', 20, 8)->nullable()->default('0.000000');
            $table->float('shipping_price_before_tax', 20, 8)->nullable()->default('0.000000');
            $table->float('shipping_tax_amount', 20, 8)->nullable()->default('0.000000');
            $table->string('tax_name')->nullable();
            $table->string('tax_value')->nullable();
            $table->string('user_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_order_carriers');
    }
}
