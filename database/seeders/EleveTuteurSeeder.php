<?php

namespace Database\Seeders;

use App\Models\Eleve;
use App\Models\Tuteur;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class EleveTuteurSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create('fr');

        $type = [];
        $paie = [];
        $relations = [];
        foreach (Eleve::all() as $eleve) {
            $tuteurs = Tuteur::inRandomOrder()->take(4)->pluck('id');
            // dd($tuteurs);
            foreach ($tuteurs as $key => $tuteur) {
                if ($key == 0) {
                    if ($this->faker->boolean(98)) {
                        $type[0] = $this->faker->boolean(80)?'tuteur':'non tuteur';
                        $paie[0] = $this->faker->boolean(90)?'resppay':'non resppay';
                        $eleve->tuteurs()->attach($tuteur,
                        [
                            'tutorrelation' => 'pere',
                            'tutortype'     => $type[0],
                            'paietype'      => $paie[0],

                        ]);
                    }
                }elseif ($key == 1) {
                    $type[1] = $this->faker->boolean(15) && (!isset($type[0]) || $type[0] != 'tuteur')?'tuteur':'non tuteur';
                    $paie[1] = $this->faker->boolean(5) && (!isset($paie[0]) || $paie[0] != 'resppay')?'resppay':'non resppay';
                    $eleve->tuteurs()->attach($tuteur,
                    [
                        'tutorrelation'     => 'mere',
                        'tutortype'     => $type[1],
                        'paietype'      => $paie[1],
                    ]);
                }

                if ($key == 2 && (!isset($type[0]) || $type[0] != 'tuteur') && (!isset($type[1]) || $type[1] != 'tuteur' )) {
                    $type[2] = 'tuteur';
                    $paie[2] = $this->faker->boolean(3) && (!isset($paie[0]) || $paie[0] != 'resppay') && (!isset($paie[1]) || $paie[1] != 'resppay')?'resppay':'non resppay';
                    $eleve->tuteurs()->attach($tuteur,
                    [
                        'tutorrelation'     => 'tuteur',
                        'tutortype'     => $type[2],
                        'paietype'      => $paie[2],
                    ]);
                }

                if ($key == 3 && (!isset($paie[0]) || $paie[0] != 'resppay') && (!isset($paie[1]) || $paie[1] != 'resppay' ) && (!isset($paie[2]) || $paie[2] != 'resppay' ) ) {
                    $eleve->tuteurs()->attach($tuteur,
                    [
                        'tutorrelation'     => 'resppay',
                        'tutortype'     => 'resppay',
                        'paietype'      => 'resppay',
                    ]);
                }
            }
        }
    }
}
