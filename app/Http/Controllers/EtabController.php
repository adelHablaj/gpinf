<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexEtabRequest;
use App\Models\Commune;
use App\Models\Detail;
use App\Models\Etab;
use App\Models\Nature;
use App\Models\Province;
use Illuminate\Http\Request;

class EtabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $cycle = [];
        $provinces = Province::pluck('ll_prov','id');
        if ($request->all()) {
            switch ($request->cycle_id) {
                case 1:
                    $cycle = ['enspres',1]; 
                    break;
                case 2:
                    $cycle = [['ensprimg'=>1],['ensprimo'=>1]]; 
                    break;
                case 3:
                    $cycle = [['enscolg'=>1], ['enscolo'=>1]]; 
                    break;
                case 4:
                    $cycle = [['ensqualg'=>1], ['ensqualo'=>1], ['ensqualt'=>1]]; 
                    break;
            }
            // dd($cycle);
            $etabs = Etab::where('cd_com', $request->commune_id)
                ->where('typeetab', '<>', 'Prive')
                ->Where(function($qr) use ($cycle){
                    foreach ($cycle as $key => $cyc) {
                        $qr->orWhere($cyc);
                    }
                })->get();
            // dd($etabs);
            $natures = Nature::pluck('NetabFr', 'id');
            $communes = Commune::where('cd_prov',$request->province_id)->pluck('ll_com', 'id');
            return view('etabs.index', [
                'province_id'=>$request->province_id, 
                'commune_id'=>$request->commune_id, 
                'cycle_id'=>$request->cycle_id,
                'provinces'=>$provinces, 
                'natures'=>$natures, 
                'communes'=>$communes, 
                'etabs'=> $etabs]);
        }else {
            return view('etabs.index', ['provinces'=>$provinces]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etab  $etab
     * @return \Illuminate\Http\Response
     */
    public function show($cd_etab)
    {
        $etab = Etab::where('cd_etab', $cd_etab)->with(['commune' => function($qr){
            $qr->select(['id', 'll_com', 'cd_prov'])->with('province:id,ll_prov');
        }])->first();
        $details = Detail::where('gresa', $cd_etab)->first();
        // dd($etab);
        return view('etabs.show', ['details' => $details, 'etab' => $etab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etab  $etab
     * @return \Illuminate\Http\Response
     */
    public function edit(Etab $etab)
    {
        dd($etab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etab  $etab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etab $etab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etab  $etab
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etab $etab)
    {
        //
    }
}
