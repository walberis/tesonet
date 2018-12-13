@extends('layouts.master')

@section('title', 'Home')

<header class="row">
    @include('layouts.header')
</header>


@section('content')





          <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            @foreach ($issues as $issue)

                                <div class="card" style="width: 18rem;">

                                    <div class="card-body">
                                        <p class="card-text">{{$issue->title}}</p>
                                    </div>
                                </div>



                            @endforeach

                        </div>
                        <div class="col">
                            2 of 2
                        </div>
                    </div>
            </div>
        </div>
@stop




