<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;


class IssueService
{

    public static function getIssue($issueUrl){

        $user = Auth::user();

        $client = new Client();
        $result = $client->GET($issueUrl, [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],
        ]);
        return  json_decode($result->getBody());;
    }

    public static function getIssueComments($issueUrl){

        $user = Auth::user();

        $client = new Client();
        $result = $client->GET($issueUrl . '/comments', [
            'headers' => [
                'Authorization' => 'token '. $user->access_token
            ],
        ]);
        return  json_decode($result->getBody());;
    }

}

