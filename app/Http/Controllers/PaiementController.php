<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyPaiementRequest;
use App\Models\Paiement;
use App\Http\Requests\StorePaiementRequest;
use App\Http\Requests\UpdatePaiementRequest;
use App\Models\Eleve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use Throwable;

class PaiementController extends Controller
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
                if ($k == 'date_echeance' && $input !== null) {
                    $this->conditions['mode'] = 'Chèque';
                }
                    $this->conditions[$k] = $input;
            }
        }
        if (isset($this->conditions) && $this->conditions !== null) {

            $paiements = Paiement::with(['eleve' => function($q){
                $q->with('tuteurs', function ($q){

                    $q->where('paietype', 'resppay');

                });

            }])->whereHas('eleve', function($query){

                $query->where($this->conditions);

            })->get();

            return  view('paiements.index', ['paiements'=> $paiements, 'inputs' => $this->conditions]);
        }

        return  view('paiements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paiements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePaiementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaiementRequest $request)
    {
        // dd($request);
        try {
            $paiement = new Paiement();
            $paiement->user_id = Auth::id();
            $paiement->fill($request->all())->save();
            return redirect()->route('paiements.edit', $paiement->id)->with('success',__('Payement Created Successfully!!'));
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->withInput()->with('error', __('Payement Cannot be saved please check the inputs!!'));
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->edit($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Paiement::where('id', $id)->exists()) {
            $paiement = Paiement::with(['eleve' => function($q){
                $q->with('tuteurs', function ($q){

                    $q->where('paietype', 'resppay');

                });

            }])->find($id);
            return view('paiements.edit', ['paiement' => $paiement]);
        }
        return redirect()->route('paiements.index')->with('Error', __('The Payement requested does not exist'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePaiementRequest  $request
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePaiementRequest $request, $id)
    {
        try {
            $paiement = Paiement::findOrFail($id);
            $paiement->user_id = Auth::id();
            $paiement->fill($request->all())->save();
            return redirect()->route('paiements.edit', $paiement->id)->with('success', __('Payement Updated Successfully!'));
        } catch (Throwable $e){
            // dd($e);
            return redirect()->back()->withInput()->with('error', __('Payement Cannot be Updated please check the inputs!!'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiement  $paiement
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyPaiementRequest $request, $id)
    {
        if($request->suppvalidation === '1'){
            try {
                $paiement = Paiement::findOrFail($id);
                $paiement->delete();
                return redirect()->route('tuteurs.index')->with('success', __('The selected Payement is DELETED successfully'));
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', __('Cannot DELETE the selected Payement'));
            }
        }
        return redirect()->back()->with('error', __('Cannot DELETE the selected Payement, Please validate!'));
    }

    public function print($id)
    {
        // dd($id);
        try {
            $paiement = Paiement::with(['Eleve:id,nom_fr,prenom_fr,massar','Eleve.tuteurs' => function ($query){
                $query->where('paietype','resppay');
            }])->findOrFail($id);

            $pdf = PDF::loadView('paiements.recu', ['paiement'=> $paiement]);
            return $pdf->stream($paiement->id.'-'.$paiement->Eleve->nom_fr.'-'.$paiement->eleve->prenom_fr.'.pdf');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->route('paiements.edit', $id)->with('error', __('Cannot Print a receipt for the selected Payement!'));
        }
    }

    public function etat(Request $request){

        foreach($request->all() as $k => $input){
            if ($input !== null && $k !== '_token') {
                if ($k == 'date_echeance' && $input !== null) {
                    $this->conditions['mode'] = 'Chèque';
                }
                    $this->conditions[$k] = $input;
            }
        }
        if (isset($this->conditions) && $this->conditions !== null) {
            if (isset($this->conditions['massar']) &&  $this->conditions['massar'] !== null) {
                $eleve = Eleve::withCount(['tuteurs'])->firstOrFail($this->conditions['massar']);
                // dd($eleve);
                return  view('paiements.etat', ['eleve'=> $eleve, 'inputs' => $this->conditions]);
            }else {
                $eleves = Eleve::withCount(['tuteurs'])->where($this->conditions)->get();
                return  view('paiements.etat', ['eleves'=> $eleves, 'inputs' => $this->conditions]);
            }
        }


        return  view('paiements.etat');
    }
}
