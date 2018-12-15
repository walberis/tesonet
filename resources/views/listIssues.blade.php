@extends('layouts.master')

@section('title', 'Home')

@section('content')

@include('layouts.header')
<style>
    .comment-icon  {
        background: url("/img/ico-logout.png") no-repeat;
        padding-right:20px;
    }
</style>
        {{--p-xl-4 p-lg-4 p-md-4 p-sm-4--}}
    <div class="row mt-5">
        <div class="col-md-6" >

            @foreach ($issues as $issue)
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column ">
                    <div class="row">
                        <img src="{{ asset('img/ico-logout.png') }}">
                        <div class="col-10 align-items-start align-text-top">

                                <a class="text-dark" href="#">
                                    {{$issue->title}}
                                </a>
                                <div class="mb-1 text-muted">Nov 12</div>



                        </div>
                        <div class="col-1 align-top">
                            @if($issue->comments > 0)
                                <div class="float-right">
                                    <img src="{{ asset('img/ico-logout.png') }}">
                                    <a class="comments-count" href="#">{{$issue->comments}}</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>


            </div>

            @endforeach
        </div>
        <div class="col-md-6">

        </div>
    </div>

@stop




