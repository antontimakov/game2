<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main.player')->insert([
            'name' => '1',
            'hit_points' => 1000,
            'mana_points' => 0,
            'experience' => 0,
            'gold' => 0
        ]);
    }
}
