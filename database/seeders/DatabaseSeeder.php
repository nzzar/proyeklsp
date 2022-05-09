<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            $this->call([
                UsersSeeder::class,
                AssesorSeeder::class,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }
}
