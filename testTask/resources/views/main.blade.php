@extends('pageTemplate')

@section('pageTitle')
    Main page
@endsection


@section('content')



    <h1> Main table </h1>
    <table class="table table-dark">
        <tr>
            <th>User ID</th>
            <th>User name</th>
            <th>User phone number</th>
            <th>Car brand</th>
            <th>Car plate number</th>
            <th>Is car on parking</th>
            <th>Car ID</th>
        </tr>
    @foreach($data as $el)
        <tr>
        @foreach($el as $col)
        <td> 
            {{$col}} 
        </td>
        @endforeach
        <td>
            <a href="/updateClient/{{$el['client_id']}}" class="btn btn-warning"><i class="fa fa-user-circle-o"></i> Update</a> 
        </td>
        
        <td>
            <a href="/deleteCar/{{$el['car_id']}}" class="btn btn-danger"><i class="fa fa-ban"></i> Delete</a> 
        </td>
        </tr>
    @endforeach
    </table>
    @if($btns > 1)
    
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="{{$prev}}">Previous</a></li>
        @for($i = 1; $i <= $btns; $i++)
        <li class="page-item"><a class="page-link" href="/{{$i}}">{{$i}}</a></li>
        @endfor
        <li class="page-item"><a class="page-link" href="{{$next}}">Next</a></li>
    </ul>
    
    @endif

@endsection
