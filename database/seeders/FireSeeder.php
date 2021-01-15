<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fire')->insert(['number_fires'=>0]);
    }
}
