@extends('pageTemplate')

@section('pageTitle')
    All cars on parking
@endsection


@section('content')


@if(count($data)> 0)
    <h1> Cars on parking </h1>
    <table class="table table-dark">
    @foreach($data as $el)
        <tr>
        @foreach($el as $col)
        <td> 
            {{$col}} 
        </td>
        @endforeach     
        <td>
            <a href="/deleteCar/{{$el['car_id']}}" class="btn btn-danger"><i class="fa fa-ban"></i> Delete</a> 
        </td>
        </tr>
    @endforeach
    </table>
    @if($btns > 1)
    
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="/allCars/{{$prev}}">Previous</a></li>
        @for($i = 1; $i <= $btns; $i++)
        <li class="page-item"><a class="page-link" href="/allCars/{{$i}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="/allCars/{{$next}}">Next</a></li>
    </ul>
    
    @endif
@else 
<h1> There's no cars in a parking right now </h1>
@endif
@endsection
