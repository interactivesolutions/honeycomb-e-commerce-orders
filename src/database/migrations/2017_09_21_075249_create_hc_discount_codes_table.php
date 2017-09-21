<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHcDiscountCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hc_discount_codes', function (Blueprint $table) {
            $table->integer('count', true);
            $table->string('id', 36)->unique('id_UNIQUE');
            $table->timestamps();
            $table->softDeletes();

            $table->string('user_id', 36)->nullable();
            $table->string('title')->nullable();
            $table->string('code', 45)->unique('unique_code');
            $table->enum('type', ['percentage', 'fixed', 'none'])->default('none');
            $table->enum('shipping_included', ['1', '0'])->default('0');
            $table->enum('free_shipping', ['1', '0'])->default('0');
            $table->float('amount', 20, 8)->default('0.000000')->nullable();
            $table->integer('total_available')->default('0');
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
            $table->float('minimum_amount', 20, 8)->default('0.000000');

            $table->foreign('user_id')->references('id')->on('hc_users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hc_discount_codes');
    }
}
