<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcCartCarrierConnectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_cart_carrier', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('cart_id', 36);
            $table->string('carrier_id', 36);
            $table->text('note')->nullable();

            $table->unique(['cart_id', 'carrier_id'], 'unique_cart_and_carrier');

            $table->foreign('cart_id')->references('id')->on('hc_carts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('carrier_id')->references('id')->on('hc_carriers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_cart_carrier');
    }
}
