<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LockersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 75; $i++) {
            DB::table('lockers')->insert([
                'locker_number' => 'Locker ' . $i,
                'is_assigned' => false,  // Los lockers están inicialmente libres
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
