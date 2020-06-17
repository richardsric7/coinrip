<?php

namespace App\Http\Controllers;

use App\Services\LogFootprint;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user(LogFootprint $logFootprint){
        $logFootprint->logvisit('Dashboard');
        return Auth()->user();
    }
}
