<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropUniqueIndexFromHcOrderInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_order_invoices', function (Blueprint $table) {

            $keyExists = DB::select(
                DB::raw(
                    'SHOW KEYS
        FROM hc_order_invoices
        WHERE Key_name=\'unique_invoice-number\''
                )
            );

            if( $keyExists ) {
                $table->dropUnique('unique_invoice-number');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_order_invoices', function (Blueprint $table) {
            //
        });
    }
}
