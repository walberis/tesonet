<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('Logout');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function Register(Request $request) {

        $credentials = app('App\Http\Controllers\HomeController')->authenticate($request);

        $user = $this->create($credentials);

        //$validator = $this->validator($credentials);

//        if ($validator->fails()) {
//            Session::flash('error', $validator->messages()->first());
//            return redirect()->back();
//        }
        Auth::login($user, false);

        return redirect()->route('myIssues');

    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'access_token' => ['required', 'string', 'max:100'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'access_token' => $data['access_token'],
        ]);
    }

    public function Logout(){
        Auth::logout();
        return redirect()->route('home');
    }

}
