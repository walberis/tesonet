<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use GuzzleHttp\Client;

//TODO API routes kitame faile
//TODO prideti state
//TODO GH secretai env file
//TODO Params kiekvienos funkcijos
//TODO VALIDACIJA
//TODO MORE SETTERS AND GETTERS

class HomeController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const GH_AUTH_CLIENT_ID = 'c22763bddd74cd382b54';
    const GH_AUTH_CLIENT_SECRET = 'e3d26ba5af0d906af154c5e24a22601b7c3232b1';
    const GITHUB_API_ISSUES = 'https://api.github.com/user/issues';

    public function showHome(){

        return view('home', ['client_id' => self::GH_AUTH_CLIENT_ID]);
    }

    public function authenticate(Request $request){
        $session_code = $request->query('code');
        $client = new Client();

        $result = $client->post('https://github.com/login/oauth/access_token', [
            'form_params' => [
                'client_id' => self::GH_AUTH_CLIENT_ID,
                'client_secret' => self::GH_AUTH_CLIENT_SECRET,
                'code' => $session_code
            ]
        ]);

        parse_str($result->getBody()->getContents(), $bodyParams);

        return $bodyParams;
    }


    public function showListIssues (){

        $issues = $this->getIssues();

        $lastPage = $this->getIssuesLastPage();

        return view('listIssues')->with(['issues' => $issues, 'lastPage' => $lastPage] );

    }

    private function getIssues($page = 1, $state = 'all'){

        $user = Auth::user();

        $client = new Client();
        $result = $client->GET(self::GITHUB_API_ISSUES, [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],

            'query'=>[
                'page'=> $page,
                'state' => $state
            ]
        ]);

        $statuscode = $result->getStatusCode();



        return json_decode($result->getBody());

    }

    private function getIssuesLastPage(){

       return;

    }

}

