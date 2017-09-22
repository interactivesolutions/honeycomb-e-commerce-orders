<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcOrderDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_order_discount_codes', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_id', 36);
            $table->string('title')->nullable();
            $table->string('code', 45);
            $table->enum('type', ['percentage', 'fixed', 'none'])->default('none');
            $table->float('amount', 20, 8)->default('0.000000')->nullable();
            $table->enum('shipping_included', ['1', '0'])->default('0');
            $table->enum('free_shipping', ['1', '0'])->default('0');

            $table->foreign('order_id')->references('id')->on('hc_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_order_discount_codes');
    }
}
