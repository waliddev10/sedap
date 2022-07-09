<?php

namespace Database\Seeders;

use App\Models\Bidang;
use App\Models\Pangkat;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return User::create([
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'jabatan' => 'Auditor Terampil',
            'pangkat_id' => Pangkat::where('nama', 'Pengatur')->first()->id,
            'bidang_id' => Bidang::where('nama', 'Bidang Perekonomian')->first()->id,
            'no_hp' => '085157626557',
            'nama' => 'Denta Ramadhana',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'role' => 'admin',
        ]);
    }
}
