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
    const GITHUB_API_ISSUES_SEACRH = 'https://api.github.com/search/issues';
    const GITHUB_API_USER = 'https://api.github.com/user';

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

    public function getUser($accessToken){

        $client = new Client();
        $result = $client->GET(self::GITHUB_API_USER, [
            'headers' => [
                'Authorization' => 'token '. $accessToken
            ],

        ]);

        return json_decode($result->getBody());
    }

    public function showListIssues ($page = 1, $state = 'all'){

        $issuesData = $this->getIssues($page, $state);


        $lastPage = 1;
        $issuesCountByState = $this->getIssuesCountByState();

        return view('listIssues')->with([
            'issues' => $issuesData['issues'],
            'lastPage' => $issuesData['lastPage'],
            'issuesCountByState' => $issuesCountByState,
            'page' => $page,
            'state' => $state ]);
    }

    private function getIssues( $page = 1,  $state = 'all'){

        $user = Auth::user();

        $client = new Client();
        $result = $client->GET(self::GITHUB_API_ISSUES, [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],

            'query'=>[
                'page'=> $page,
                'state' => $state,
                'per_page' => 10
            ]
        ], ['debug' => true]);

        $lastPage = $this->getIssuesLastPage($result);


        return ['issues' => json_decode($result->getBody()), 'lastPage' => $lastPage];
    }


    private function getIssuesLastPage($response){

        $linkHeader = $response->getHeader('Link');

        $lastPage = 1;
        foreach ($linkHeader as $link) {
            preg_match('/page=([0-9])&state=([a-z]*)&per_page=([0-9]*)>; rel="last"/', $link, $matches);

            if ($matches) {
                $lastPage = $matches[1];
            }
        }
       return $lastPage;
    }



    private function getIssuesCountByState(){

        $user = Auth::user();

        $client = new Client();
        $openIssues = $client->GET(self::GITHUB_API_ISSUES_SEACRH . '?q=assignee:'. $user->login .' type:issue state:open', [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],
        ]);

        $closedIssues = $client->GET(self::GITHUB_API_ISSUES_SEACRH . '?q=assignee:'.$user->login.' type:issue state:closed', [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],


        ]);

       $openIssuesCount =  json_decode($openIssues->getBody());

       $closedIssuesCount =  json_decode($closedIssues->getBody());

       return [
           'openedIssuesCount' => $openIssuesCount->total_count,
           'closedIssuesCount' => $closedIssuesCount->total_count,

       ];
    }
}

