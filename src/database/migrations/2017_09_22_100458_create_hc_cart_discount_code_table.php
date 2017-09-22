<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcCartDiscountCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_cart_discount_code', function (Blueprint $table) {
            $table->integer('count', true);
            $table->timestamps();

            $table->string('cart_id', 36);
            $table->string('discount_code_id', 36);

            $table->unique(['cart_id', 'discount_code_id'], 'unique_cart_and_discount_code');

            $table->foreign('cart_id')->references('id')->on('hc_carts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('discount_code_id')->references('id')->on('hc_discount_codes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_cart_discount_code');
    }
}
