<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyTuteurRequest;
use App\Http\Requests\StoreEleveTuteurRequest;
use App\Models\Tuteur;
use App\Http\Requests\StoreTuteurRequest;
use App\Http\Requests\UpdateTuteurRequest;
use App\Models\Eleve;
use App\Models\Nationalite;
use App\Models\Niveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class TuteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());
        foreach($request->all() as $k => $input){
            if ($input !== null && $k !== '_token') {
                    $this->conditions[$k] = $input;
            }
        }

        // dd($this->conditions['cin']);
        // $niveaux = Niveau::pluck('nom','id');
        if (isset($this->conditions['massar']) && $this->conditions['massar'] !== null) {
            $tuteurs = Tuteur::withCount(['eleves'])->whereHas('eleves',function($q){
                $q->where($this->conditions);
            })->get();
            // dd($tuteurs);
            return  view('tuteurs.index', ['tuteurs'=> $tuteurs, 'inputs' => $this->conditions]);
        }elseif(isset($this->conditions['cin']) && $this->conditions['cin'] !== null) {
            $tuteurs = Tuteur::withCount(['eleves'])->where($this->conditions)->get();
            // dd($tuteurs);
            return  view('tuteurs.index', ['tuteurs'=> $tuteurs, 'inputs' => $this->conditions]);
        }elseif(isset($this->conditions)) {
            $tuteurs = Tuteur::whereHas('eleves',function($q){
                $q->where($this->conditions);
            })->withCount('eleves')->get();
            // dd($tuteurs);
            return  view('tuteurs.index', ['tuteurs'=> $tuteurs, 'inputs' => $this->conditions]);
        }

        return  view('tuteurs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nationalites = Nationalite::orderBy('label','ASC')->pluck('label', 'id');
        return view('tuteurs.create', ['nationalites'=> $nationalites]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTuteurRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTuteurRequest $request, StoreEleveTuteurRequest $requestEleveTuteur)
    {
        // dd($request->all());
        $eleve_id = isset($request->eleve_id)?$request->eleve_id:null;
        $tutorrelation = isset($request->tutorrelation)?$request->tutorrelation:null;
        $tutortype = isset($request->tutortype)?$request->tutortype:null;
        $paietype = isset($request->paietype)?$request->paietype:null;
        $eleveTuteurData = compact('tutorrelation','tutortype','paietype');
        // dd($eleveTuteurData);

        $request->request->remove('eleve_id');
        $request->request->remove('massar');
        $request->request->remove('tutorrelation');
        $request->request->remove('tutortype');
        $request->request->remove('paietype');

        DB::beginTransaction();
        try {
            // dd($eleve_id);
            $tuteur = new Tuteur();
            $tuteur->user_id = Auth::id();
            $tuteur->fill($request->all())->save();

            if (isset($eleve_id)){
                //
                // var_dump('test tuteur et resppay\n');
                $eleveTutors = Eleve::with('tuteurs')->find($eleve_id);
                if($tutortype == 'tuteur' || $paietype == 'resppay') {

                    foreach ($eleveTutors->tuteurs as $eleveTuteur) {
                        if ($tutortype == 'tuteur') {
                            // var_dump('test tuteur\n');
                            //recuperer l'ancient tuteur
                            if ($eleveTuteur->pivot->tutortype == 'tuteur') {
                                // var_dump('test oldtuteur\n');
                                $oldTutor = $eleveTuteur;
                            }
                        }
                        if ($paietype == 'resppay') {
                            //recuperer l'ancient payer
                            // var_dump('test oldresppay\n');
                            if ($eleveTuteur->pivot->paietype == 'resppay') {
                                $oldPayer = $eleveTuteur;
                            }
                        }
                    }

                    //modify tutors and payement responsable
                    if (isset($oldTutor->id) && $tuteur->id !== $oldTutor->id) {
                        $eleveTutors->tuteurs()->syncWithoutDetaching([$oldTutor->id => ['tutortype'=>'non tuteur'],$tuteur->id =>['tutortype'=>$tutortype]]);
                        // var_dump('sync oldtut et newtut\n');
                    }

                    if (!isset($oldTutor->id) && isset($tuteur->id)) {
                        $eleveTutors->tuteurs()->syncWithoutDetaching([$tuteur->id =>['tutortype'=>$tutortype]]);
                        // $eleveTutors->tuteurs()->attach($tuteur->id, ['tutortype'=>'tuteur']);
                        // var_dump('sync newtut\n');
                    }

                    if (isset($oldPayer->id) && $tuteur->id !== $oldPayer->id) {
                        // var_dump('sync oldpayer et newpayer\n');
                        $eleveTutors->tuteurs()->syncWithoutDetaching([$oldPayer->id => ['paietype'=>'non resppay'],$tuteur->id =>['paietype'=>$paietype]]);
                    }
                    if (!isset($oldPayer->id) && isset($tuteur->id)) {
                        $eleveTutors->tuteurs()->syncWithoutDetaching([$tuteur->id =>['paietype'=>$paietype]]);
                        // $eleveTutors->tuteurs()->attach($tuteur->id, ['tutortype'=>'tuteur']);
                        // var_dump('sync newpayer\n');
                    }

                    $eleveTutors->tuteurs()->syncWithoutDetaching([$tuteur->id =>['tutorrelation' => $tutorrelation]]);

                    // var_dump('sync relation only\n');
                }else {
                    if (isset($tuteur->id)) {
                        $eleveTutors->tuteurs()->syncWithoutDetaching([$tuteur->id =>['paietype'=>$paietype, 'tutortype'=>$tutortype, 'tutorrelation' => $tutorrelation]]);
                        // var_dump('sync all types\n');
                    }
                }
            }
            DB::commit();
            // dd($eleveTutors);
            // dd('end all tests');
            if ($request->ajax()) {
                return response()->json([$tuteur, 'message' => ['success',__('Tutor Created Successfully!!')]]);
            }else {
                return redirect()->route('tuteurs.edit', $tuteur->id)->with('success',__('Tutor Created Successfully!!'));
            }

        } catch (\Throwable $th) {
            DB::rollback();
            if ($request->ajax()) {
                dd($th->validator->messages()->all());

                return response()->json([$th,'message' => [$th->validator->messages()->all(),'error', __('Tutor Cannot be saved please check the inputs!!')]]);
            }else {
                return redirect()->back()->withInput()->with('error', __('Tutor Cannot be saved please check the inputs!!'));
            }
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tuteur  $tuteur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tuteur  $tuteur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Tuteur::where('id', $id)->exists()) {
            $tuteur = Tuteur::with(['eleves:id,massar,nom_fr,prenom_fr,genre,date_nais,avatar,niveau_id'])->find($id);
            // $tuteur['tuteurs_list'] = Tuteur::get(['cin','id']);
            $niveaux = Niveau::pluck('nom','id');
            $nationalites = Nationalite::pluck('label','id');
            return view('tuteurs.edit', ['tuteur' => $tuteur, 'niveaux'=>$niveaux, 'nationalites'=>$nationalites]);
        }
        return redirect()->route('tuteurs.index')->with('Error', __('The Tutor requested does not exist'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTuteurRequest  $request
     * @param  \App\Models\Tuteur  $tuteur
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTuteurRequest $request, $id)
    {
        // dd($request->all());
            try {
                $tuteur = Tuteur::findOrFail($id);
                $tuteur->user_id = Auth::id();
                $tuteur->fill($request->all())->update();
                return redirect()->route('tuteurs.edit', $tuteur->id)->with('success', __('Tutor Successfully Updated!'));
            } catch (Throwable $e){
                // dd($e);
                return redirect()->back()->withInput()->with('error', __('Tutor Cannot be Updated please check the inputs!!'));
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tuteur  $tuteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyTuteurRequest $request, $id)
    {
        if($request->suppvalidation === '1'){
            try {
                $tuteur = Tuteur::findOrFail($id);
                $tuteur->delete();

                if ($request->ajax()) {
                    return response()->json([$tuteur->id,['success', __('The selected Tutor is DELETED successfully')]]);
                }else {
                    return redirect()->route('tuteurs.index')->with('success', __('The selected Tutor is DELETED successfully'));
                }
            } catch (\Throwable $th) {
                // dd($th);
                if ($request->ajax()) {
                    return response()->json([$tuteur->id,['error', __('Cannot DELETE the selected Tutor')]]);
                }else {
                    return redirect()->back()->with('error', __('Cannot DELETE the selected Tutor'));
                }
            }
        }
        return redirect()->back()->with('error', __('Cannot DELETE the selected Tutor, Please validate!'));
    }

    public function import()
    {
        return redirect()->route('home');
    }
}
