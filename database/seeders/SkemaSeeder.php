<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\Skema;
use App\Models\UnitKompetensi;
use App\Models\UnjukKerja;
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

        $skema = new Skema();
        $skema->name = 'Pemrograman Aplikasi Dasar';
        $skema->nomor = 'SSK.01 TI/2018';
        $skema->active = true;
        $skema->save();
        
        $unit1 = new UnitKompetensi();
        $unit1->skema_id = $skema->id;
        $unit1->kode = 'J.620100.004.02';
        $unit1->judul = 'Menggunakan struktur data';
        $unit1->save();

        $unit2 = new UnitKompetensi();
        $unit2->skema_id = $skema->id;
        $unit2->kode = 'J.620100.009.01';
        $unit2->judul = 'Menggunakan Spesifikasi Program';
        $unit2->save();


        $element11 = new Element();
        $element11->unit_kompetensi_id = $unit1->id;
        $element11->name = 'Mengidentifikasi konsep data dan struktur data';
        $element11->save();

        $element12 = new Element();
        $element12->unit_kompetensi_id = $unit1->id;
        $element12->name = 'Menerapkan struktur data dan akses terhadap struktur data tersebut';
        $element12->save();

        $element21 = new Element();
        $element21->unit_kompetensi_id = $unit2->id;
        $element21->name = 'Menggunakan metode pengembangan program';
        $element21->save();

        $unjukKerja1 = new UnjukKerja();
        $unjukKerja1->element_id = $element11->id;
        $unjukKerja1->description = 'Konsep data dan struktur data diidentifikasi sesuai dengan konteks permasalahan';
        $unjukKerja1->save();

        $unjukKerja2 = new UnjukKerja();
        $unjukKerja2->element_id = $element11->id;
        $unjukKerja2->description = 'Alternatif struktur data dibandingkan kelebihan dan kekurangannya untuk konteks permasalahan yang diselesaikan';
        $unjukKerja2->save();

        $unjukKerja3 = new UnjukKerja();
        $unjukKerja3->element_id = $element12->id;
        $unjukKerja3->description = 'Struktur data diimplementasikan sesuai dengan bahasa pemrograman yang akan dipergunakan';
        $unjukKerja3->save();

        $unjukKerja4 = new UnjukKerja();
        $unjukKerja4->element_id = $element12->id;
        $unjukKerja4->description = 'Akses terhadap data dinyatakan dalam algoritma yang efisien sesuai bahasa pemrograman yang akan dipakai';
        $unjukKerja4->save();

        $unjukKerja4 = new UnjukKerja();
        $unjukKerja4->element_id = $element21->id;
        $unjukKerja4->description = 'Metode pengembangan aplikasi (Software development) didefinisikan';
        $unjukKerja4->save();
    }
}
