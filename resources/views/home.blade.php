@extends('layouts.master')

@section('title', 'Home')
@section('content')
          <div class="flex-center position-ref full-height">
              {{--          @if (Route::has('login'))
                          <div class="top-right links">
                              @auth
                                  <a href="{{ url('/home') }}">Home</a>
                              @else
                                  <a href="{{ route('login') }}">Login</a>

                                  @if (Route::has('register'))
                                      <a href="{{ route('register') }}">Register</a>
                                  @endif
                              @endauth
                          </div>
                      @endif
          --}}
            <div class="content">
                <div class="title m-b-md">
                    <a href="https://github.com/login/oauth/authorize?scope=repo:status,user&client_id={{$client_id}}" class="btn btn-primary" role="button">
                        Login With GitHub
                    </a>

                </div>
            </div>
        </div>
@stop
