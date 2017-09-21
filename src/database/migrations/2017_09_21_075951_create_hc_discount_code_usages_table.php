<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcDiscountCodeUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_discount_code_usages', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_id', 36);
            $table->string('discount_code_id', 36);

            $table->unique(['order_id', 'discount_code_id'], 'unique_discount_code_and_order_id');

            $table->foreign('order_id')->references('id')->on('hc_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('hc_discount_code_usages');
    }
}
