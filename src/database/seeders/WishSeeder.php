<?php

namespace Database\Seeders;

use App\Models\Wish;
use Illuminate\Database\Seeder;

class WishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Wish::factory()->count(200)->create();
    }
}
