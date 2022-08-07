<?php

namespace Database\Seeders;

use App\Models\UmpanBalik;
use Illuminate\Database\Seeder;

class UmpanBalikSeeder extends Seeder
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
                "komponen" => "Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen / uji kompetensi"
            ],
            [
                "komponen" => "Saya diberikan kesempatan untuk mempelajari standar kompetensi yang akan diujikan dan menilai diri sendiri terhadap pencapaiannya"
            ],
            [
                "komponen" => "Asesor memberikan kesempatan untuk mendiskusikan/menegosiasikan metoda, instrumen dan sumber asesmen serta jadwal asesmen"
            ],
            [
                "komponen" => "Asesor berusaha menggali seluruh bukti pendukung yang sesuai dengan latar belakang pelatihan dan pengalaman yang saya miliki"
            ],
            [
                "komponen" => "Saya sepenuhnya diberikan kesempatan untuk mendemonstrasikan kompetensi yang saya miliki selama asesmen"
            ],
            [
                "komponen" => "Saya mendapatkan penjelasan yang memadai mengenai keputusan asesmen"
            ],
            [
                "komponen" => "Asesor memberikan umpan balik yang mendukung setelah asesemen serta tindak lanjutnya"
            ],
            [
                "komponen" => "Asesor bersama saya mempelajari semua dokumen asesmen serta menandatanganinya"
            ],
            [
                "komponen" => "Saya mendapatkan jaminan kerahasiaan hasil asesmen serta penjelasan penanganan dokumen asesmen"
            ],
            [
                "komponen" => "Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen"
            ],
        ];

        UmpanBalik::insert($data);
    }
}
