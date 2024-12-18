<?php

namespace Database\Seeders;

use App\Models\PenggunaWilayah;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Register;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pusat
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('nw4kpfzduBfeCpY'),
            'level' => '0',
        ]);

        // Regional
        User::create([
            'name' => 'wilayah',
            'email' => 'wilayah@gmail.com',
            'password' => Hash::make('nw4kpfzduBfeCpY'),
            'level' => '1',
        ]);
        PenggunaWilayah::create([
            'nama_pengguna' => 'Pengguna Wilayah',
            'jabatan_pengguna' => 'Ketua Wilayah',
            'hp_pengguna' => '08123456789',
            'alamat_pengguna' => 'Alamat Pengguna Wilayah',
            'nama_wilayah' => 'BPK Wilayah',
            'alamat_wilayah' => 'Alamat Wilayah',
            'user_id' => '2',
        ]);
    }
}
