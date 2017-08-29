<?php
namespace interactivesolutions\honeycombecommerceorders\database\seeds;

use Illuminate\Database\Seeder;

class HoneyCombDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HCECOrderStatesSeed::class);
    }
}