<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthenticateService;
use Illuminate\Http\Request;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/my-issues';
    protected $authenticateService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthenticateService $authenticateService)
    {
        $this->middleware('guest')->except('Logout');
        $this->authenticateService = $authenticateService;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function Register(Request $request ) {

        $user = $this->authenticateService->authenticate($request);

        if($user){
            Auth::login($user, false);
        }

        return redirect()->route('myIssues');

    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
