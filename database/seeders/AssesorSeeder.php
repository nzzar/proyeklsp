<?php

namespace Database\Seeders;

use App\Models\Asesor;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssesorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $user = User::where('role', 'asesor')->first();
        
        Asesor::insert([
            'user_id' => $user->id,
            'nik' => '12343545',
            'name' => 'Aay bae',
            'birth_date' => '1999-05-20',
            'phone' => '0871232323',
            'gender' => 'p',
            'address' => 'not empty ok !',
            'reg_number' => 'REG-12345678',
            'blanko_number' => 'BLANKO-12345',
            'education' => 'S1 Management',
            'profession' => 'Profession Copywriter',
            'start_date' => '2020-05-20',
            'expired_date' => '2023-05-20',
        ]);

    }
}
