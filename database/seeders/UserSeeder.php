<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'admin',
            'email' => 'amitie@gmail.com',
            'password' => Hash::make('4m1TI3A6ency'),
        ]);

        // Register::create([
        //     'fullname' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'num_phone' => '72074242',
        //     'company' => 'test',
        // ]);
    }
}
