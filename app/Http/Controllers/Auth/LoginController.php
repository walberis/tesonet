<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


use App\GitHubAuth\AuthenticatesGitHubUsers;



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

    use AuthenticatesGitHubUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function Login(Request $request){

        $credentials = app('App\Http\Controllers\HomeController')->authenticate($request);



        if (AuthenticatesGitHubUsers::login($credentials)) {
            // Authentication passed...

            var_dump('yes');die();
            return redirect()->intended('dashboard');
        }

    }




    public function Logout(){

        Auth::logout();

        return view('home');
    }
}
