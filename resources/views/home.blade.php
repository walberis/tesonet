@extends('layouts.master')

@section('title', 'Home')
@section('content')
          <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    <a href="https://github.com/login/oauth/authorize?scope=repo,user&client_id={{$client_id}}" class="btn btn-primary" role="button">
                        Login With GitHub
                    </a>

                </div>
            </div>
        </div>
@stop
