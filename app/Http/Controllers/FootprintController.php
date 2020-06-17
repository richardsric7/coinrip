<?php

namespace App\Http\Controllers;

use App\Footprint;
use App\Services\LogFootprint;
use Illuminate\Support\Facades\DB;

class FootprintController extends Controller
{
    public function __construct(LogFootprint $logFootprint)
    {
        $logFootprint->logvisit('Footprints');
        $this->middleware('auth');
    }

    public function footprint(){
        $footprints = Footprint::paginate(10);
    $country_visits = Footprint::select(DB::raw('count(*) as visits, country'))->groupBy('country')->get();

        return compact('country_visits', 'footprints');
    }
}
