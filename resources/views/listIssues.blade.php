@extends('layouts.master')

@section('title', 'List Issues')

@section('content')

@include('layouts.header')

    <div class="row mt-5 px-4">
        <div class="col-md-6 ">
            <div class="scrollable px-3" id="scrollbar">
                <div class="row justify-content-md-center">

                    <div class="col-md-auto pb-3">

                        <a class="{{$state !== 'open' ? 'text-muted' : ''}}"
                           href="{{route('myIssues', array('page' => $page, 'state' =>'open'))}}">
                            Open
                            {{$issuesCountByState['openedIssuesCount']}}
                        </a>

                        <a class={{$state !== 'closed' ? 'text-muted' : ''}} href="{{route('myIssues', array('page' => $page, 'state' =>'closed'))}}">
                            Closed
                            {{$issuesCountByState['closedIssuesCount']}}
                        </a>
                    </div>

                </div>

                @foreach ($issues as $issue)

                    <div class="card flex-md-row mb-4 box-shadow h-md-250">
                        <div class="card-body d-flex flex-column ">

                            <div class="row">
                                <div class="float-left pt-0 pl-4">
                                    <img src="{{ asset('img/exclamation-icon.png') }}">
                                </div>
                                <div class=" mx-2">
                                    <a class="text-dark"
                                       href="{{route('Issue', array('login' =>$issue->user->login, 'repo' => $issue->repository->name, 'number' => $issue->number))}}">
                                        {{$issue->title}}
                                    </a>
                                    <div class="mb-1 text-muted small">#{{$issue->number}}
                                        opened {{IssueHelper::getTimeDiff($issue->created_at)}} by <a class="user-color"
                                                                                                      href="">{{$issue->user->login}}</a>
                                    </div>

                                </div>
                                @if($issue->comments > 0)
                                    <div class="float-right pt-0 pl-4">
                                        <div class="float-right">
                                            <img src="{{ asset('img/comment-icon.png') }}">
                                            <a class="text-muted" href="#">{{$issue->comments}}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>


                    </div>
                @endforeach
            </div>
            @component('paginator', ['page' => $page, 'lastPage' => $lastPage, 'state' => $state]) @endcomponent
        </div>
        <div class="col-md-6">
        </div>
    </div>
@stop




