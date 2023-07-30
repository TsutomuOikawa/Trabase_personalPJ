<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 200; $i++) { 
            DB::table('favorites')->insert([
                'user_id' => fake()->numberBetween(1, 20),
                'note_id' => fake()->numberBetween(1, 100),
            ]);
        }
    }
}
