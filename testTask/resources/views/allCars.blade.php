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

    <div class="container box">
        <h3> Change car parking status </h3>
    <form method="post" action="/changeParking">
    @csrf
    <div class="form-group">
        <select name="client_id" id="client_id" data-dependent="car_id" class="form-control dynamic">
            <option value="">Select user</option>
            @foreach($user_list as $user)
            <option value="{{$user->client_id}}"> {{$user->client_id}}. {{$user->full_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <select name="car_id" id="car_id"  class="form-control">
            <option value="">Select car</option> 
        </select>
    </div>
    <button type="submit" class="btn btn-warning"> Change car status </button>
   
</form>
</div>
    
@else 
<h1> There's no cars in a parking right now </h1>
@endif

<script>
    $(document).ready(function()
    {
        $('.dynamic').change(function(){
            if($(this).val()!='')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                console.log("Dependent:"+dependent);
                console.log("Select:"+select);
                console.log("Value:"+value);

                $.ajax({
                    url:"{{route('mainController.fetch')}}",
                    method: "POST",
                    data:{select:select, value:value, _token:_token,
                    dependent:dependent},
                    success: function(result)
                    {
                        $('#'+dependent).html(result);
                    }
                })
            }
        })
    })
</script>
@endsection
