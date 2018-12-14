@extends('layouts.master')

@section('title', 'Home')

@section('content')

@include('layouts.header')

        {{--p-xl-4 p-lg-4 p-md-4 p-sm-4--}}
    <div class="row mt-5">
        <div class="col-md-6" >

            @foreach ($issues as $issue)
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <strong class="d-inline-block mb-2 text-primary">{{$issue->title}}</strong>
                    <h3 class="mb-0">
                        <a class="text-dark" href="#">Featured post</a>
                    </h3>
                    <div class="mb-1 text-muted">Nov 12</div>
                </div>
                <img class="card-img-right flex-auto d-none d-md-block" data-src="{{ asset('img/ico-logout.png') }}" alt="Card image cap">
            </div>

            @endforeach
        </div>
        <div class="col-md-6">

        </div>
    </div>

@stop




