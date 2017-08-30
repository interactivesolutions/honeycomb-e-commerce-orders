<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_orders', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_state_id', 36)->nullable();
            $table->string('user_id', 36)->nullable();

            $table->string('reference', 255)->nullable();
            $table->string('payment', 255)->nullable();

            $table->float('total_price', 20, 6)->nullable()->default("0.000000");
            $table->float('total_price_before_tax', 20, 6)->nullable()->default("0.000000");
            $table->float('total_discounts', 20, 6)->nullable()->default("0.000000");
            $table->float('total_discounts_before_tax', 20, 6)->nullable()->default("0.000000");
            $table->float('total_paid', 20, 6)->nullable()->default("0.000000");
            $table->float('total_paid_before_tax', 20, 6)->nullable()->default("0.000000");
            $table->text('order_note')->nullable();

            $table->foreign('user_id')->references('id')->on('hc_users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('order_state_id')->references('id')->on('hc_order_states')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_orders');
    }
}
