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



        $user = $this->createOrUpdateUser($result);

        return $user;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function createOrUpdateUser(array $data)
    {
        $apiUserData = app('App\Http\Controllers\HomeController')->getUser($data['access_token']);

        return User::updateOrCreate(
            ['login' => $apiUserData->login],

            [
                'access_token' => $data['access_token'],
                'avatar_url' => $apiUserData->avatar_url,
                'login' => $apiUserData->login
            ]
        );
    }

}