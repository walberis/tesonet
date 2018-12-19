@extends('layouts.master')
@section('title', 'Issue')
@section('content')

@include('layouts.header')
<div class="container-fluid">
        <div class=" mx-auto col-md-8 col-lg-8 col-sm-8" >
            <div class="mb-3"> <img src="{{ asset('img/ico-back.png') }}"> <a class="user-color" href="{{url()->previous()}}">Back to Issues</a></div>
            <div class=" mt-4">
            <div class="jumbotron no-bg card-border">
                <div>
                    <h1><span> {{$issue->title}}</span> <span class="text-muted"> #{{$issue->number}}</span></h1>
                    <div>
                        <div class="float-left issue-state-button">
                            <img src="{{ asset('img/ico-open.png') }}"> <span class="text-uppercase ">{{$issue->state}}</span>
                        </div>

                        <div class="text-muted small issue-text"><a href="{{$issue->user->url}}" class="pl-3 user-color" >{{$issue->user->login}}</a> opened this issue {{IssueHelper::getTimeDiff($issue->created_at)}}
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
@if ($comments)
    @foreach($comments as $comment)
        <div class="row mt-4 ">
            <div class=" col-sm-1 col-lg-1 col-md-1 d-none d-sm-block  ">
        <img src="{{$comment->user->avatar_url}}" class="rounded-circle small-img">
        </div>
        <div class="col-sm-11 col-lg-11 col-md-11 ">
            <div class="card card-border">
                <div class="card-header bg-transparent card-border-bottom">
                    <a href="{{$comment->user->url}}" class="user-color" >{{$comment->user->login}} </a> <span> commented {{IssueHelper::getTimeDiff($comment->created_at)}}</span>
                </div>

                <div class="card-body">
                    {{$comment->body}}

                </div>
            </div>

        </div>


    </div>
    @endforeach

    @else

                <div class="text-center text-muted small"> No comments </div>
    @endif
        </div>
</div>


@stop




