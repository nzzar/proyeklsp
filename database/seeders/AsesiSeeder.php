<?php

namespace Database\Seeders;

use App\Models\Asesi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Database\Seeder;

class AsesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role', 'asesi')->first();
        $prodi = Prodi::first();

        Asesi::insert(
            [
                'user_id' => $user->id,
                'prodi_id' => $prodi->id,
                'nim' => '234323',
                'name' => 'Asesi Aay',
            ]
        );
    }
}
