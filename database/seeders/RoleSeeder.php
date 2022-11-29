<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'nom'   =>  'Administrateur',
                'label' =>  'admin AREF',
                'level' =>  '1',
            ],
            [
                'nom'   =>  'Operateur',
                'label' =>  'Operateur DP',
                'level' =>  '2',
            ],
            [
                'nom'   =>  'Utilisateur',
                'label' =>  'Utilisateur Etab',
                'level' =>  '3',
            ],
        ];
        Role::insert($roles);
    }
}
