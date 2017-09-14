<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserNotifiedFieldToHcCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_carts', function (Blueprint $table) {
            $table->enum('user_notified', ['yes', 'waiting'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_carts', function (Blueprint $table) {
            $table->dropColumn('user_notified');
        });
    }
}
