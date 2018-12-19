<?php

namespace App\Services;

use App\User;
use Illuminate\Http\Request;
use App\Http\ApiRequest;


class AuthenticateService
{

    protected $ApiRequest;

    public function __construct( ApiRequest $ApiRequest )
    {
        $this->ApiRequest = $ApiRequest;
    }


    public function authenticate(Request $request){

        $result = $this->ApiRequest->authRequest($request->query('code'));
        $user = $this->createOrUpdateUser($result['access_token']);

        return $user;
    }

    protected function createOrUpdateUser($access_token)
    {
        $response = $this->ApiRequest->getRequest(config('github.links.GITHUB_API_USER'), $access_token);

        $apiUserData =  json_decode($response->getBody());

        return User::updateOrCreate(
            ['login' => $apiUserData->login],

            [
                'access_token' => $access_token,
                'avatar_url' => $apiUserData->avatar_url,
                'login' => $apiUserData->login
            ]
        );
    }

}