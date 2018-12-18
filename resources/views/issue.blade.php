@extends('layouts.master')

@section('title', 'Issue')

@section('content')

@include('layouts.header')
<div class="container-fluid">
    <div class="row mt-5">
        <div class=" mx-auto col-md-8" >
            <div class="mb-3"> <img src="{{ asset('img/ico-back.png') }}"> <a class="user-color" href="{{route('myIssues', array('page' => $page, 'state' =>$state))}}">Back to Issues</a></div>
            <div class="jumbotron no-bg">
                <div>
                    <h1><span> {{$issue->title}}</span> <span class="text-muted"> #{{$issue->number}}</span></h1>
                    <div>
                        <div class="float-left issue-state-button">
                            <img src="{{ asset('img/ico-open.png') }}"> <span class="text-uppercase ">{{$issue->state}}</span>
                        </div>

                        <div class="text-muted small issue-text"><a href="" class="pl-3 user-color" >{{$issue->user->login}}</a> opened this issue {{IssueHelper::getTimeDiff($issue)}}
                            @if($issue->comments > 0)
                                <a class="text-muted-small dot-sign">{{$issue->comments}}</a>
                                @if ($issue->comments > 1 )
                                    comments
                                @else
                                    comment
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop




