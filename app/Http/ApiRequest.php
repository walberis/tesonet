<?php


namespace App\Http;

use GuzzleHttp\Client;


class ApiRequest
{
    public function authRequest($session_code){
        $client = new Client();

        $result = $client->post(config('github.links.GITHUB_ACCESS_TOKEN'), [
            'form_params' => [
                'client_id' => config('github.auth.GH_AUTH_CLIENT_ID'),
                'client_secret' => config('github.auth.GH_AUTH_CLIENT_SECRET'),
                'code' => $session_code
            ]
        ]);

        parse_str($result->getBody()->getContents(), $bodyParams);

        return $bodyParams ;
    }

    public function getRequest(){


    }
}
