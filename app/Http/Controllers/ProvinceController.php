<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Etab;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces = Province::withCount(['commune' ,'etabs' => function($qr){
            $qr->where('df_etab', null); //ouvertes
        }])->get();
        // dd($provinces);
        return view('provinces.index', ['provinces'=> $provinces]);
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
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $province = Province::withCount(['commune' ,'etabs' => function($qr){
            $qr->where('df_etab', null); //ouvertes
        }])->where('id',$id)->first();
        $etabs = Etab::where('df_etab', null)->with('commune')->whereHas('commune', function($qr) use ($id) {
            $qr->whereHas('province', function($q) use ($id) {
                $q->where('id', $id);
            });
        })->pluck('cd_etab');

        $details['pc_nbr'] = Detail::whereIn('gresa', $etabs)->sum('pc_nbr');
        $details['admin_manque'] = Detail::whereIn('gresa', $etabs)->sum('admin_manque');
        $details['enseignemant_manque'] = Detail::whereIn('gresa', $etabs)->sum('enseignemant_manque');
        $details['vmm'] = Detail::whereIn('gresa', $etabs)->sum('vmm');
        $details['vmm_manque'] = Detail::whereIn('gresa', $etabs)->sum('vmm_manque');
        $details['smm_manque'] = Detail::whereIn('gresa', $etabs)->sum('vmm_manque');
        $details['smm'] = Detail::where('smm','<>','0')
            ->whereIn('gresa', $etabs)->count();
        $details['rac_internet'] = Detail::where('rac_internet','<>','null')
            ->where('rac_internet','<>','non')
            ->whereIn('gresa', $etabs)->count();
        $details['vp'] = Detail::whereIn('gresa', $etabs)->sum('vp');
        $details['vp_manque'] = Detail::whereIn('gresa', $etabs)->sum('vp_manque');
        $details['nbr_eleves'] = Detail::whereIn('gresa', $etabs)->sum('nbr_eleves');
        // $test = Detail::where('smm','<>' '0')->whereIn('gresa', $etabs)->count();
        // dd($test);
        return view('provinces.show', ['province' => $province, 'details' => $details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Province  $province
     * @return \Illuminate\Http\Response
     */
    public function destroy(Province $province)
    {
        //
    }
}
