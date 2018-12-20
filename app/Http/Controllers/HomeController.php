<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;


class HomeController extends BaseController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHome(){
        return view('home', ['client_id' => config('github.auth.GH_AUTH_CLIENT_ID')]);
    }
}

