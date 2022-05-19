<?php

namespace Database\Seeders;

use App\Models\Skema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;

class SkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = date('Y-m-d');
        $endDate = date_format(date_add(date_create($startDate), date_interval_create_from_date_string('30 days')), 'Y-m-d');
        
        Skema::insert([
            'name' => 'Pemrograman Aplikasi Dasar',
            'nomor' => 'SSK.01 TI/2018',
            'active' => true,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }
}
