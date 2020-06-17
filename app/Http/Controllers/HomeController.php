<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogFootprint;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(LogFootprint $logFootprint)
    {
        $logFootprint->logvisit('Home');
        return view('landingpage');
    }
}
