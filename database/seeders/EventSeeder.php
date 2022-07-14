<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Skema;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skema = Skema::firstOrFail();
        
        $data = new Event();
        $data->skema_id = $skema->id;
        $data->title = 'Pemrograman Aplikasi Dasar 1';
        $data->start_date = Carbon::now();
        $data->end_date = Carbon::now()->addDay(10);
        $data->status = 'Approved';
        $data->qty = 20;
        $data->tuk = 'Ruang TUK Gedung TI Lantai 2';
        $data->active = true;
        $data->save();
        
    }
}
