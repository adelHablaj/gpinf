<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyEleveRequest;
use App\Http\Requests\SearchEleveRequest;
use App\Models\Eleve;
use App\Http\Requests\StoreEleveRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdateEleveRequest;
use App\Http\Requests\UpdateTuteurRequest;
use App\Models\Nationalite;
use App\Models\Niveau;
use App\Models\Tuteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;
use PDF;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        foreach($request->all() as $k => $input){
            if ($input !== null && $k !== '_token') {
                if($k == 'fullname'){
                    $name = explode(' ',$input,2);
                    $conditions['nom_fr'] = $name[0];
                    $conditions['prenom_fr'] = isset($name[1])?$name[1]:'';
                }else{
                    $conditions[$k] = $input;
                }
            }
        }

        $niveaux = Niveau::pluck('nom','id');
        if (isset($conditions) && $conditions !== null) {
            $eleves = Eleve::with(['Niveau'])->where($conditions)->get();
            return  view('eleves.index', ['niveaux'=> $niveaux, 'eleves' => $eleves, 'inputs' => $conditions]);
        }

        return  view('eleves.index', ['niveaux'=> $niveaux]);

    }

    public function notpayed() {
        $eleves = Eleve::doesntHave('paiement')->get();
        $niveaux = Niveau::pluck('nom', 'id');
        return view('eleves.notpayed', ['eleves' => $eleves, 'niveaux' => $niveaux]);
    }

    public function findnotpayed(Request $request) {

        $niveaux = Niveau::pluck('nom', 'id');
        if (count($request->all()) > 0) {
            $this->mois = $request->mois;
            $this->niveau = $request->niveau_id;

            $eleves = Eleve::with(['detailpaiement'=> function($qr){

                $qr->select('id','montant','montant_due','eleve_id')->where('mois', $this->mois);

            }])->whereHas('detailpaiement',function($q){

                $q->where(['mois'=>$this->mois])->whereRaw('montant < montant_due');

            })->where(function ($query)
            {
                if(isset($this->niveau)){

                    $query->where('niveau_id', $this->niveau);
                }
            })->get();
            return view('eleves.findnotpayed', ['niveaux' => $niveaux, 'eleves' => $eleves]);
        }
        return view('eleves.findnotpayed', ['niveaux' => $niveaux]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaux = Niveau::pluck('nom', 'id');
        $nationalites = Nationalite::orderBy('label','ASC')->pluck('label', 'id');
        return view('eleves.create', ['nationalites'=> $nationalites, 'niveaux'=> $niveaux]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEleveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEleveRequest $request)
    {
        try {
            $eleve = new Eleve();
            $eleve->fill($request->all())->save();
            return redirect()->route('eleves.edit', $eleve->id)->with('success',__('Student Created Successfully!!'));
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->with('error', __('Student Cannot be saved please check the inputs!!'));
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show($eleve)
    {
       return $this->edit($eleve);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Eleve::where('id', $id)->exists()) {
            $eleve = Eleve::with(['tuteurs','paiement' => function ($query)
            {
                $query->orderBy('date', 'ASC');
            }])->find($id);

            $eleve['sumPayed'] = $eleve->paiement->sum('montant');
            $moisPayables = [__('SEP') => 0,__('OCT') => 0,__('NOV') => 0,__('DEC') => 0,__('JAN') => 0,__('FEB') => 0,__('MAR') => 0,__('APR') => 0,__('MAY') => 0,__('JUN') => 0,__('JUL') => 0];
            $eleve['aPayerParMois'] = $eleve->mensualite + $eleve->bus + $eleve->garde;
            $restInscription = $eleve['sumPayed'] - $eleve->inscription;
            $eleve['inscriptionPayer'] = ($restInscription < 0)?$eleve['sumPayed']:$eleve->inscription;
            if ($restInscription > 0) {
                foreach ($moisPayables as $key => $mois) {
                    $restInscription -= $eleve['aPayerParMois'];
                    if ($restInscription < 0 &&  abs($restInscription) <= $eleve['aPayerParMois'] ) {
                        $moisPayables[$key] = $eleve['aPayerParMois'] + $restInscription;
                    }elseif ($restInscription >= 0) {
                        $moisPayables[$key] = $eleve['aPayerParMois'];
                    }
                }
            }
            $eleve['moisPayables'] = $moisPayables;

            $eleve['niveaux'] = Niveau::pluck('nom','id');
            $nationalites = Nationalite::pluck('label','id');
            // $eleve['tuteurs_list'] = Tuteur::get(['cin','id']);
            return view('eleves.edit', ['eleve' => $eleve, 'nationalites' => $nationalites]);
        }
        return redirect()->route('eleves.index')->with('Error', __('The Student requested does not exist'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEleveRequest  $request
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEleveRequest $request, $id)
    {
        // values to use for setting tutor and payement responsables
        $tutor_id = $request->settutor;
        $resppay_id = $request->setresppay;
        $tuteurs = $request->tuteurs;
        $tutors = Eleve::with('tuteurs')->find($id);
        foreach ($tutors->tuteurs as $index => $tts) {
            if ($tts->pivot->tutortype == 'tuteur') {
                $oldTutor = $tts;
            }
            if ($tts->pivot->paietype == 'resppay') {
                $oldPayer = $tts;
            }
            if ($tts->id == $tutor_id) {
                $newTutor = $tts;
            }
            if ($tts->id == $resppay_id) {
                $newPayer = $tts;
            }
        }
        // $oldTutor = isset($oldTutor)?$oldTutor:$newTutor;
        // $oldPayer = isset($oldPayer)?$oldPayer:$newPayer;



        $request->request->remove('settutor');
        $request->request->remove('setresppay');
        $request->request->remove('tuteurs');

            try {
                $eleve = Eleve::with('tuteurs')->findOrFail($id);

                //modify tutors and payement responsable
                if (isset($oldTutor->id) && $newTutor->id !== $oldTutor->id) {
                    $eleve->tuteurs()->syncWithoutDetaching([$oldTutor->id => ['tutortype'=>'non tuteur'],$newTutor->id =>['tutortype'=>'tuteur']]);
                }

                if (!isset($oldTutor->id) && isset($newTutor->id)) {
                    $eleve->tuteurs()->syncWithoutDetaching([$newTutor->id =>['tutortype'=>'tuteur']]);
                    // $eleve->tuteurs()->attach($newTutor, ['tutortype'=>'tuteur']);
                }

                if (isset($oldPayer->id) && $newPayer->id !== $oldPayer->id) {
                    $eleve->tuteurs()->syncWithoutDetaching([$oldPayer->id => ['paietype'=>'non resppay'],$newPayer->id =>['paietype'=>'resppay']]);
                }

                if (!isset($oldPayer->id) && isset($newPayer->id)) {
                    $eleve->tuteurs()->syncWithoutDetaching([$newPayer->id =>['paietype'=>'resppay']]);
                }

                //set user id
                $eleve->user_id = Auth::id();

                //update eleve
                $eleve->fill($request->all())->update();

                //update related tuteurs comming from edit eleve
                foreach ($tuteurs as $id => $ttor) {

                    // create update tuteurs request
                    $tutorRequest = new UpdateTuteurRequest();

                    // get update request rules
                    $rules = $tutorRequest->replace($ttor)->rules();

                    // validate turor data request
                    $this->validate($tutorRequest,$rules);
                    Tuteur::find($id)->update($tutorRequest->all());
                }

                return redirect()->route('eleves.edit', $eleve->id)->with('success', __('Student Successfully Updated!'));
            } catch (Throwable $e){
                //
                return redirect()->back()->withInput()->withErrors($e->validator->messages()->all())->with('error', __('Student Cannot be Updated please check the inputs!!'));
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyEleveRequest $request, $id)
    {
        if($request->suppvalidation === '1'){
            try {
                $eleve = Eleve::findOrFail($id);
                $eleve->delete();

                return redirect()->route('eleves.index')->with('success', __('The selected student is DELETED successfully'));
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Cannot DELETE the selected student'));
            }
        }
        return redirect()->back()->with('error', __('Cannot DELETE the selected student, Please validate!'));
    }


    public function print($id, $doc)
    {
        try {
            $eleve = Eleve::with('niveau')->findOrFail($id);

            $pdf = PDF::loadView('eleves.'.$doc, ['eleve'=> $eleve]);
            return $pdf->stream($eleve->id.'-'.$eleve->nom_fr.'-'.$eleve->prenom_fr.'-'.$doc.'.pdf');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function search(SearchEleveRequest $request){
        try {
            $eleve = Eleve::where('massar',$request->massar)->select('id','massar','nom_fr', 'prenom_fr')->with(['tuteurs' => function($q){
                $q->select('nom_fr', 'prenom_fr')->where('paietype', 'resppay');
            }])->firstOrFail();
            return $eleve;

        } catch(\Throwable $th){
            return ['resultat'=>0];
        }

    }

    public function uploadavatar(UpdateAvatarRequest $request)
    {
        try {
            $eleve = Eleve::findOrFail($request->eleve_id);
            $medias = $eleve->getMedia('');
            if (count($medias) > 0) {
                foreach ($medias as $key => $md) {
                    if (isset($medias[$key])) {
                        $medias[$key]->delete();
                    }
                }
            }
            // $path = $medias[0]->getUrl();
            DB::beginTransaction();
            $media = $eleve
                ->addMediaFromRequest('avatar')
                ->sanitizingFileName(function($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' ','@', '_', '^'], '-', $fileName));
                 })
                ->toMediaCollection('','eleve_images');

            file_exists($media->getPath(''))?unlink($media->getPath('')):null;

            $filePath = str_replace(public_path(DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'students'.DIRECTORY_SEPARATOR),'',$media->getPath('profile'));
            // dd($filePath);
            $eleve
                ->fill(['avatar' => $filePath])
                ->update();

            DB::commit();

            return response()->json([$filePath,'message' => [__('Photo successfully Updated!')]]);

        } catch (\Throwable $th) {

            DB::rollBack();

            response()->json(['message' => [$th,'error', __('Photo Cannot be Updated please try again!')]]);

        }

        // dd($eleve->getMediaUrl('images'));

    }


}
