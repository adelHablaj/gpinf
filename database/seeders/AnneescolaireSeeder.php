<?php

namespace Database\Seeders;

use App\Models\Anneescolaire;
use Illuminate\Database\Seeder;

class AnneescolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anneescolaires = [
            [
                'annee' => '2022',
                'label' => '2021/2022',
            ],
            [
                'annee' => '2023',
                'label' => '2022/2023',
            ],
            [
                'annee' => '2024',
                'label' => '2023/2024',
            ],
        ];
        Anneescolaire::insert($anneescolaires);
    }
}
