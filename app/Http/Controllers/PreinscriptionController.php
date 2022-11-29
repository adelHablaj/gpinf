<?php

namespace App\Http\Controllers;

use App\Http\Requests\RejectPreinscriptionRequest;
use App\Models\Preinscription;
use App\Http\Requests\StorePreinscriptionRequest;
use App\Http\Requests\SubscribePreinscriptionRequest;
use App\Http\Requests\UnrejectPreinscriptionRequest;
use App\Http\Requests\UpdatePreinscriptionRequest;
use App\Models\Eleve;
use App\Models\Niveau;
use Carbon\Carbon;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Psy\debug;

class PreinscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        foreach($request->all() as $k => $input){
            if ($input !== null && $k !== '_token') {
                $conditions[$k] = $input;
            }
        }

        if (isset($conditions) && $conditions !== null) {
            $preinscriptions = Preinscription::with(['Niveau:id,nom'])->where($conditions)->get();
            return view('preinscriptions.index', ['preinscriptions' => $preinscriptions]);
        }

        return view('preinscriptions.index');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $niveaux = Niveau::pluck('nom','id');
        return view('preinscriptions.create', ['niveaux' => $niveaux] );
    }

    public function subscribe(SubscribePreinscriptionRequest $request, $id)
    {
        // dd($request);
        if (Preinscription::where('id', $id)->exists()) {
            $preinscription = Preinscription::find($id);
            $eleve = new Eleve();

            $eleve->massar = $request->massar;
            $eleve->prenom_fr = $preinscription['prenom_fr'];
            $eleve->nom_fr = $preinscription['nom_fr'];
            $eleve->prenom_ar = $preinscription['prenom_ar'];
            $eleve->nom_ar = $preinscription['nom_ar'];
            $eleve->date_nais = $preinscription['date_nais'];
            $eleve->genre = $request->genre;
            $eleve->phone_urgence = $preinscription['phone'];
            $eleve->phone_descipline = $preinscription['phone'];
            $eleve->adresse = $preinscription['adresse'];
            $eleve->prevenance = $preinscription['prevenance'];
            $eleve->niveau_id = $preinscription['niveau_id'];
            $eleve->date_inscription = now()->format('Y-m-d');
            $eleve->observation = $preinscription['observation'];
            $eleve->user_id = Auth::id();

            try {
                $eleve->save();
                $preinscription->delete();
                return redirect()->route('eleves.edit', $eleve->id)->with('success', __('Student Successfully subscribed!'));
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->withInput()->with('error', __('Student Cannot be subscribed, please check the inputs!!'));
            }

        }
    }
    public function reject(RejectPreinscriptionRequest $request, $id)
    {
            if (Preinscription::where(['id'=> $id, 'decision'=>1])->exists()) {
                $preinscription = Preinscription::find($id);
                $preinscription->observation = $preinscription->observation.PHP_EOL.$request['observation'];
                $preinscription->decision = 0;
                try {
                    $preinscription->save();
                    return redirect()->route('preinscriptions.edit', $preinscription->id)->with('success', __('Student Successfully REJECTED!'));
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', __('Student Cannot be REJECTED, please check the inputs!!'));
                }
            }
            return redirect()->back()->withInput()->with('error', __('Student Dont exist or alredy REJECTED!!'));
        }


        public function unreject(UnrejectPreinscriptionRequest $request, $id)
        {
            if (Preinscription::where(['id'=> $id, 'decision' => 0])->exists()) {
                $preinscription = Preinscription::find($id);
                $preinscription->observation = $preinscription->observation.PHP_EOL.$request['observation'];
                $preinscription->decision = 1;
                try {
                    $preinscription->save();
                    return redirect()->route('preinscriptions.edit', $preinscription->id)->with('success', __('Student Successfully UNREJECTED!'));
                } catch (\Throwable $th) {
                    return redirect()->back()->withInput()->with('error', __('Student Cannot be UNREJECTED, please check the inputs!!'));
                }
            }
            return redirect()->back()->withInput()->with('error', __('Student Dont exist or alredy registred!!'));
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreinscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreinscriptionRequest $request)
    {
        $preinscription = new Preinscription();
        $preinscription->prenom_fr = $request['prenom_fr'];
        $preinscription->nom_fr = $request['nom_fr'];
        $preinscription->prenom_ar = $request['prenom_ar'];
        $preinscription->nom_ar = $request['nom_ar'];
        $preinscription->date_nais = $request['date_nais'];
        $preinscription->age = Carbon::parse($request['date_nais'])->diff(Carbon::now())->y;
        $preinscription->phone = $request['phone'];
        $preinscription->adresse = $request['adresse'];
        $preinscription->prevenance = $request['prevenance'];
        $preinscription->niveau_id = $request['niveau_id'];
        $preinscription->date_test = $request['date_test'];
        $preinscription->observation = $request['observation'];
        $preinscription->user_id = Auth::id();

        $preinscription->decision = 1;
        // dd($preinscription);


        // dd($preinscription);
        try {
            $preinscription->save();
            return redirect()->route('preinscriptions.edit', $preinscription->id)->with('success',__('preinscription Created Successfully!!'));
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->withInput()->with('error', __('preinscription Cannot be saved please check the inputs!!'));
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preinscription  $preinscription
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preinscription  $preinscription
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Preinscription::where('id', $id)->exists()) {
            $preinscription = Preinscription::find($id);
            $preinscription['niveaux'] = Niveau::pluck('nom','id');
            return view('preinscriptions.edit', ['preinscription' => $preinscription]);
        }
        return redirect()->route('preinscriptions.index')->with('Error', __('The Preinscription requested does not exist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreinscriptionRequest  $request
     * @param  \App\Models\Preinscription  $preinscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreinscriptionRequest $request, $id)
    {
        try {
            $preinscription = Preinscription::findOrFail($id);

            $preinscription->prenom_fr = $request['prenom_fr'];
            $preinscription->nom_fr = $request['nom_fr'];
            $preinscription->prenom_ar = $request['prenom_ar'];
            $preinscription->nom_ar = $request['nom_ar'];
            $preinscription->date_nais = $request['date_nais'];
            $preinscription->age = $request['age'];
            $preinscription->phone = $request['phone'];
            $preinscription->adresse = $request['adresse'];
            $preinscription->prevenance = $request['prevenance'];
            $preinscription->niveau_id = $request['niveau_id'];
            $preinscription->date_test = $request['date_test'];
            $preinscription->observation = $request['observation'];

            $preinscription->save();

            return redirect()->route('preinscriptions.edit', $id)->with('success',__('preinscription Updated Successfully!!'));

        } catch (\Throwable $th) {

            return redirect()->back()->withInput()->with('error', __('preinscription Cannot be Updated please check the inputs!!'));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preinscription  $preinscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preinscription $preinscription)
    {
        //
    }
}
