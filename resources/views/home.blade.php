@extends('layouts.master')

@section('title', 'Home')
@section('content')
          <div class="flex-center position-ref full-height login-bg">
            <div class="content">
                <img src="{{ asset('img/logo-testio-white.png') }}">
                <div class="title m-b-md">
                    <a href="https://github.com/login/oauth/authorize?scope=repo,user&client_id={{$client_id}}" class="btn main-login-button text-white" role="button">
                        Login With GitHub
                    </a>
                </div>
            </div>
        </div>
@stop
