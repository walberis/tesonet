@extends('layouts.master')

@section('title', 'Home')

@section('content')

@include('layouts.header')

    <div class="row mt-5">
        <div class="col-md-6" >

            <div class="row justify-content-md-center">

                <div class="col-md-auto">

                    <a class="{{$state !== 'open' ? 'text-muted' : ''}}" href="{{route('myIssues', array('page' => $page, 'state' =>'open'))}}">
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
                            <a class="text-dark" href="">
                                {{$issue->title}}
                            </a>
                        <div class="mb-1 text-muted small">#{{$issue->number}} opened {{IssueHelper::getTimeDiff($issue)}} by <a href=""><span class="login-name">{{$issue->user->login}}</span></a></div>

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

            <nav aria-label="...">
                <ul class="pagination justify-content-center">
                    <li class="page-item page-item-nav {{$page == 1 ? 'disabled' : ''}}">
                        <a class="page-link page-link-nav" href="#" tabindex="-1">Previous</a>
                    </li>
                    @php $pageCount=1 @endphp
                    @while( $pageCount < 4 && $pageCount <= $lastPage )
                    <li class="page-item rounded-pagination {{$page == $pageCount ? 'active' : ''}}">
                        <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
                    </li>
                        @php $pageCount++ @endphp
                    @endwhile



                        @php $pageCount = $lastPage @endphp
                        @if($lastPage > 5)
                        <li>...</li>
                        @endif
                        @while($pageCount >=4 && $pageCount-1 <= $lastPage)

                            <li class="page-item rounded-pagination {{$page == $pageCount-1 ? 'active' : ''}}">
                                <a class="page-link" href="{{route('myIssues', array('page' => $pageCount-1, 'state' =>$state))}}">{{$pageCount-1}}</a>
                            </li>
                            @php $pageCount++ @endphp
                        @endwhile



                    <li class=" page-item page-item-nav {{$page == $lastPage ? 'disabled' : ''}}">
                        <a class="page-link page-link-nav" href="#">Next</a>
                    </li>
                </ul>
            </nav>


        </div>
        <div class="col-md-6">

        </div>
    </div>

@stop




