<?php


namespace App\Http;

use GuzzleHttp\Client;


class ApiRequest
{
    /**
     * @param $session_code
     * @return mixed
     */
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

    /**
     * @param $uri
     * @param $access_token
     * @param null $query
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getRequest($uri, $access_token, $query = null){

        $client = new Client();

        if ($query){
            return  $client->GET($uri, [
                'headers' => [
                    'Authorization' => 'token '. $access_token
                ],
                'query' => $query
            ]);
        }

        return  $client->GET($uri, [
            'headers' => [
                'Authorization' => 'token '. $access_token
            ],
        ]);

    }
}
