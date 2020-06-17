<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\LogFootprint;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LogFootprint $logFootprint)
    {
        $logFootprint->logvisit('Login');
        $this->middleware('guest')->except('logout');
    }

    // public function authenticate()
    // {
    //     request()->validate([
    //         'email' => 'bail | required | email',
    //         'password' => 'bail | required | min:8',
    //     ]);

    //     if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

    //         return redirect()->intended('home');
    //     }
    //     return back()->withErrors(['email' => ['Invalid Credentials.']]);
    // }
}
