<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Detail;
use App\Models\Etab;
use App\Models\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $province['provinces'] = Province::count();
        $province['etabs'] = Etab::where('df_etab', null)->count();
        $province['communes'] = Commune::count();
        $etabs = Etab::where('df_etab', null)->pluck('cd_etab');

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
        // dd($province);
        return view('home', ['province' => $province, 'details' => $details]);
    }
}
