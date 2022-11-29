<?php

namespace Database\Seeders;

use App\Models\Niveau;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $niveaux = [
            [
                'nom'   => '1APRES',
                'label' => 'الأولى أولي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '2APRES',
                'label' => 'االثانية أولي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '1APG',
                'label' => 'الأول ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '2APG',
                'label' => 'الثاني ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '3APG',
                'label' => 'الثالث ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '4APG',
                'label' => 'الرابع ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '5APG',
                'label' => 'الخامس ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '6APG',
                'label' => 'السادس ابتدائي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '1APIC',
                'label' => 'الأولى إعدادي مسار دولي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '1ASCG',
                'label' => 'الأولى إعدادي عام',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '2APIC',
                'label' => 'الثانية إعدادي مسار دولي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '2ASCG',
                'label' => 'الثانية إعدادي عام',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '3APIC',
                'label' => 'الثالثة إعدادي مسار دولي',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],
            [
                'nom'   => '3ASCG',
                'label' => 'الثالثة إعدادي عام',
                'nbr_classe'    => '0',
                'user_id' =>    1,
            ],

        ];
        Niveau::insert($niveaux);
    }
}
