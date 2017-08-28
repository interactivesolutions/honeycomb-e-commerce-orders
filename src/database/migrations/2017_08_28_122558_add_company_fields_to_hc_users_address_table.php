<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyFieldsToHcUsersAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hc_users_address', function (Blueprint $table) {
            $table->string('company_name', 255)->nullable();
            $table->string('company_code', 255)->nullable();
            $table->string('company_vat', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hc_users_address', function (Blueprint $table) {
            $table->dropColumn('company_name', 'company_code', 'company_vat');
        });
    }
}
