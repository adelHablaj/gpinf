<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AnneescolaireSeeder::class,
            EleveSeeder::class,
            NationaliteSeeder::class,
            NiveauSeeder::class,
            PaiementSeeder::class,
            PreinscriptionSeeder::class,
            RoleSeeder::class,
            TuteurSeeder::class,
            UserSeeder::class,
            EleveTuteurSeeder::class,
            DetailPaiementSeeder::class,

        ]);
    }
}
