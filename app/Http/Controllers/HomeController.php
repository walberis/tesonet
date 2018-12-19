<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

//TODO Params kiekvienos funkcijos
//TODO VALIDACIJA
//TODO MORE SETTERS AND GETTERS
//TODO PHP VERSION REQUIRED

class HomeController extends BaseController
{
    public function showHome(){
        return view('home', ['client_id' => config('github.auth.GH_AUTH_CLIENT_ID')]);
    }
}

