@extends('pageTemplate')

@section('pageTitle')
    All cars on parking
@endsection


@section('content')


@if(count($data)> 0)
    <div id="app">
        <cartable-comp :mydata="{{json_encode($data)}}"></cartable-comp>
        @if($btns > 1)
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="/allCars/{{$prev}}">Previous</a></li>
                @for($i = 1; $i <= $btns; $i++)
                    <li class="page-item"><a class="page-link" href="/allCars/{{$i}}">{{$i}}</a></li>
                @endfor
                <li class="page-item"><a class="page-link" href="/allCars/{{$next}}">Next</a></li>
            </ul>
        @endif
        <dependentselect></dependentselect>
    </div>


@else
<h1> There's no cars right now </h1>
@endif

@endsection
