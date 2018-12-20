<nav class="pt-4">
    <ul class="pagination justify-content-center">
        <li class="page-item page-item-nav {{$page == 1 ? 'disabled' : ''}}">
            <a class="page-link page-link-nav" href="{{route('myIssues', array('page' => $page-1, 'state' =>$state))}}" tabindex="-1">Previous</a>
        </li>
        @php $pageCount = 1 @endphp
        @while( $lastPage < 6 && $pageCount <= 6 )
            <li class="page-item rounded-pagination {{$page == $pageCount ? 'active' : ''}}">
                <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
            </li>
            @php $pageCount++ @endphp
        @endwhile

        @if($lastPage >= 6 && $page <= 3)

            @while( $pageCount <= 3 )
                <li class="page-item rounded-pagination {{$page == $pageCount ? 'active' : ''}}">
                    <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
                </li>
                @php $pageCount++ @endphp
            @endwhile

            <li>...</li>
            @php $pageCount = $lastPage @endphp

            @while( $pageCount-1 <= $lastPage  )
                <li class="page-item rounded-pagination">
                    <a class="page-link" href="{{route('myIssues', array('page' => $pageCount-1, 'state' =>$state))}}">{{$pageCount-1}}</a>
                </li>
                @php $pageCount++ @endphp
            @endwhile


        @endif
        @if($page > 3 && $lastPage > 6 && $page < $lastPage-2)

            <li class="page-item rounded-pagination">
                <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
            </li>


            <li>...</li>
            @for ($pageCount = $page -1 ; $pageCount <= $page +1; $pageCount++ )
                @if($pageCount == $page)

                    <li class="page-item rounded-pagination active">
                        <a class="page-link" href="{{route('myIssues', array('page' => $page, 'state' =>$state))}}">{{$page}}</a>
                    </li>
                @else
                    <li class="page-item rounded-pagination">
                        <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
                    </li>
                @endif
            @endfor
            <li>...</li>
            @php $pageCount = $lastPage @endphp
            @while( $pageCount-1 <= $lastPage  )
                <li class="page-item rounded-pagination">
                    <a class="page-link" href="{{route('myIssues', array('page' => $pageCount-1, 'state' =>$state))}}">{{$pageCount-1}}</a>
                </li>
                @php $pageCount++ @endphp
            @endwhile

        @endif
        @if($page >= $lastPage-2 && $lastPage > 6)

            @while(  $pageCount <= 3 )
                <li class="page-item rounded-pagination {{$page == $pageCount ? 'active' : ''}}">
                    <a class="page-link" href="{{route('myIssues', array('page' => $pageCount, 'state' =>$state))}}">{{$pageCount}}</a>
                </li>
                @php $pageCount++ @endphp
            @endwhile
            <li>...</li>
            @php $pageCount = $lastPage @endphp
            @while( $pageCount-1 <= $lastPage )
                <li class="page-item rounded-pagination {{$page == $pageCount-1 ? 'active' : ''}}">
                    <a class="page-link" href="{{route('myIssues', array('page' => $pageCount-1, 'state' =>$state))}}">{{$pageCount-1}}</a>
                </li>
                @php $pageCount++ @endphp
            @endwhile

        @endif



        <li class=" page-item page-item-nav {{$page == $lastPage ? 'disabled' : ''}}">
            <a class="page-link page-link-nav" href="{{route('myIssues', array('page' => $page+1, 'state' =>$state))}}">Next</a>
        </li>
    </ul>
</nav>