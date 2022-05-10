<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => 'D3 Teknik Informatika'
            ],
            [
                "name" => 'D4 Rekayasa Perangkat Lunak'
            ],
        ];

        Prodi::insert($data);
    }
}
