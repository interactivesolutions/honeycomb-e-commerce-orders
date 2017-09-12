<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_order_details', function (Blueprint $table) {
            $table->foreign('good_id')->references('id')->on('hc_goods');
            $table->foreign('warehouse_id')->references('id')->on('hc_warehouses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_order_details', function (Blueprint $table) {
            $table->dropForeign(['good_id']);
            $table->dropForeign(['warehouse_id']);
        });
    }
}
