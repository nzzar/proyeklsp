<?php

namespace Database\Seeders;

use App\Models\User;
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
        $userData = [
            [
                'email' => 'lspasesor@gmail.com',
                'password' => Hash::make('lspasesor1234'),
                'role' => 'asesor',
                'active' => true,
            ],
            [
                'email' => 'lspasesi@gmail.com',
                'password' => Hash::make('lspasesi1234'),
                'role' => 'asesi',
                'active' => true,
            ],
            [
                'email' => 'lspadmin@gmail.com',
                'password' => Hash::make('lspadmin1234'),
                'role' => 'admin',
                'active' => true,
            ],
        ];

        User::insert($userData);
    }
}
