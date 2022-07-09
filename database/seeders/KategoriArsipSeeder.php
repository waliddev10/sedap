<?php

namespace Database\Seeders;

use App\Models\KategoriArsip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class KategoriArsipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return KategoriArsip::insert([
            [
                'nama' => 'Arsip SPT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Arsip Penugasan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nama' => 'Jadwal PKPT',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
