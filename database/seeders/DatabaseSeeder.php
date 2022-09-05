<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction();

        try {
            // kalo mau ada yang dimatiin initial data nya disini
            $this->call([
                // ProdiSeeder::class,
                // SkemaSeeder::class,
                // PersyaratanSkemaSeeder::class,
                // EventSeeder::class,
                UsersSeeder::class,
                // AssesorSeeder::class,
                // AsesiSeeder::class,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
