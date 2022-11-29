<?php

namespace Database\Seeders;

use App\Models\DetailPaiement;
use App\Models\Eleve;
use App\Models\Paiement;
use Illuminate\Database\Seeder;

class DetailPaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eleves = Eleve::select('id', 'inscription', 'mensualite', 'bus', 'garde')->withSum('paiement', 'montant')->get();
        // $paiements = Paiement::with(['eleve' => function($q){
            //     $q->select('id', 'inscription', 'mensualite', 'bus', 'garde')->withSum('paiement','montant');
            // }])->paginate(2);
            // dd($paiements->all());
            // dd($eleves[6]);
            $moisPayables = [9 => 0,10 => 0, 11 => 0,12 => 0, 1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0];

            foreach ( $eleves as $eleve) {

            if ($eleve->paiement_sum_montant !== null) {
                // montant à payer par mois
                $dp[$eleve->id]['aPayerParMois'] = $eleve->mensualite + $eleve->bus + $eleve->garde;
                $dp[$eleve->id]['inscription'] = $eleve->inscription;

                // le reste du total montant  aprés le retrait les frais d'inscription
                $restInscription = $eleve->paiement_sum_montant - $eleve->inscription;

                // le monatant payer pour l'inscription
                $dp[$eleve->id]['inscriptionPayer'] = ($restInscription < 0)?$eleve->paiement_sum_montant:$eleve->inscription;

                // $eleve->id==81?dd($restInscription):'';
                //
                if ($restInscription > 0) {
                    foreach ($moisPayables as $key => $mois) {
                        if ($restInscription > 0 && $restInscription < $dp[$eleve->id]['aPayerParMois'] ) {
                            $moisPayables[$key] = $restInscription;
                        }elseif ($restInscription >= $dp[$eleve->id]['aPayerParMois']) {
                            $moisPayables[$key] = $dp[$eleve->id]['aPayerParMois'];
                        }else {
                            $moisPayables[$key] = 0;
                        }
                        $restInscription -= $dp[$eleve->id]['aPayerParMois'];
                        // var_dump($restInscription);
                        // }
                    }
                }else {
                    foreach ($moisPayables as $key => $mois) {

                            $moisPayables[$key] = 0;
                    }
                }
                $dp[$eleve->id]['moisPayables'] = $moisPayables;
                $detailpaiement[] = [

                ];
            }
    }
    // dd($dp[302]);

    foreach ($dp as $eleveId => $dtlpay) {

        foreach ($dtlpay['moisPayables'] as $mois => $montant) {
                DetailPaiement::create([
                    'eleve_id'  => $eleveId,
                    'mois'      => $mois,
                    'montant'   => $montant,
                    'montant_due'   => $dtlpay['aPayerParMois'],
                    'annee_scolaire' => now(),
                ]);
            }
            DetailPaiement::create([
                'eleve_id'  => $eleveId,
                'mois'      => 0,
                'montant'   => $dtlpay['inscriptionPayer'],
                'montant_due'   => $dtlpay['inscription'],
                'annee_scolaire' => now(),
        ]);
    }

    }
}
