<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_cart_items', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('cart_id', 36);
            $table->string('goods_id', 36);
            $table->string('combination_id', 36);
            $table->integer('amount')->unsigned();

            $table->index(['cart_id', 'goods_id', 'combination_id'], 'unique_cart_and_goods_combination_id');

            $table->foreign('cart_id')->references('id')->on('hc_carts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('goods_id')->references('id')->on('hc_goods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('combination_id')->references('id')->on('hc_goods_combinations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hc_cart_items');
    }
}
