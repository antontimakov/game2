<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnemySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main.enemy')->insert([
            'name' => 'enemy 1',
            'hit_points' => 20000,
            'mana_points' => 0,
            'experience' => 100,
            'gold' => 100
        ]);
    }
}
