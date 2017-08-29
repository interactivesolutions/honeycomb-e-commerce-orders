<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_order_details', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('order_id', 36);
            $table->string('good_id', 36);
            $table->string('combination_id', 36)->nullable();
            $table->string('warehouse_id', 36)->nullable();

            $table->string('tax_name')->nullable();
            $table->string('tax_value')->nullable();

            $table->integer('amount')->unsigned()->default(1);
            $table->string('reference')->nullable();
            $table->text('name')->nullable();
            $table->float('price', 20, 6)->nullable()->default("0.000000");
            $table->float('price_before_tax', 20, 6)->nullable()->default("0.000000");
            $table->float('total_price', 20, 6)->nullable()->default("0.000000");
            $table->float('total_price_before_tax', 20, 6)->nullable()->default("0.000000");

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
        Schema::dropIfExists('hc_order_details');
    }
}
