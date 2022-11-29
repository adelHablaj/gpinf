<?php

namespace Database\Seeders;

use App\Models\Preinscription;
use Illuminate\Database\Seeder;

class PreinscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Preinscription::factory(85)->create();
    }
}
