<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_order_history', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_id', 36);
            $table->string('order_state_id', 36);
            $table->text('note')->nullable();

            $table->foreign('order_id')->references('id')->on('hc_orders')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('hc_order_history');
    }
}
