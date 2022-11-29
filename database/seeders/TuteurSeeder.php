<?php

namespace Database\Seeders;

use App\Models\Tuteur;
use Illuminate\Database\Seeder;

class TuteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tuteur::factory(20000)->create();
    }
}
