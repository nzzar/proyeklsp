<?php

namespace Database\Seeders;

use App\Models\PersyaratanSkema;
use App\Models\Skema;
use Illuminate\Database\Seeder;

class PersyaratanSkemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skema = Skema::firstOrFail();
        
        $persyaratan = new PersyaratanSkema();
        $persyaratan->skema_id = $skema->id;
        $persyaratan->name = 'Fotocopy Izajah SMA / Sederajat';
        $persyaratan->save();
    }
}
