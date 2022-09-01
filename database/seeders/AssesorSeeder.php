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
            'name' => 'Adi Suheryadi',
            'birth_date' => '1999-05-20',
            'phone' => '085224100168',
            'gender' => 'p',
            'address' => 'Cirebon',
            'reg_number' => 'No. Reg. Met.000.007167 2018',
            'blanko_number' => '5922222',
            'education' => 'S1 Management',
            'profession' => 'Dosen',
            'start_date' => '2021-03-26',
            'expired_date' => '2024-03-26',
        ]);

    }
}
