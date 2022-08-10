@extends('pageTemplate')

@section('pageTitle')
    Main page
@endsection


@section('content')

@if(count($data) > 0)
<div id="app">
    <usertable-comp :mydata="{{json_encode($data)}}"> </usertable-comp>
</div>


    @if($btns > 1)
    
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$prev}}">Previous</a></li>
        @for($i = 1; $i <= $btns; $i++)
        <li class="page-item"><a class="page-link" href="/{{$i}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$next}}">Next</a></li>
    </ul>
    @endif
    @else 
    <h1> There's no information in database to create a table </h1>
    @endif
    
@endsection

