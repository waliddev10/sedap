<?php

use Database\Seeders\BidangSeeder;
use Database\Seeders\KategoriArsipSeeder;
use Database\Seeders\PangkatSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BidangSeeder::class);
        $this->call(PangkatSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(KategoriArsipSeeder::class);
    }
}
