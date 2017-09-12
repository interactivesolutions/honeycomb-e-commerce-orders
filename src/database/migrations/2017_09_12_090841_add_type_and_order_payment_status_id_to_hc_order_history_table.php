<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeAndOrderPaymentStatusIdToHcOrderHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_order_history', function (Blueprint $table) {
            $table->string('order_state_id', 36)->nullable()->change();

            $table->enum('type', ['order-state', 'payment-status'])->nullable()->after('order_id');
            $table->string('order_payment_status_id', 36)->nullable()->after('order_state_id');

            $table->foreign('order_payment_status_id')->references('id')->on('hc_order_payment_status')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_order_history', function (Blueprint $table) {
            $table->dropForeign(['order_payment_status_id']);

            $table->dropColumn('order_payment_status_id', 'type');
        });
    }
}
