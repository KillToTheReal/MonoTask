@extends('pageTemplate')

@section('pageTitle')
    Update Client data
@endsection

@section('content')

<h1> Update client </h1>
@if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $err)
                <li>
                    {{$err}}
                </li>
                @endforeach
            </ul>
        </div>
@endif
    <form method="post" class="bg-6 md-6 sm-6" action="/updateClient" id="userForm">
        @csrf
        <h4>Full name <h4>
        <input type = "hidden" value="{{$data[0][0]->client_id}}" name="client_id" id = "client_id"> 
        <input  type="text" value="{{$data[0][0]->full_name}}" placeholder="3 characters min" required name = "full_name" id ="name" class="form-control">
         <h4>Phone number<h4> 
        <input type = "tel" value="{{$data[0][0]->phone_num}}" placeholder="Format: +78005553535, unique" required name = "phone_num" id ="phone" class="form-control">
        <h4>Gender <h4>
        <select class="form-select" required name="gender" id="gender">
            <option value="1">Male</option>
            <option value="0">Female</option>
        </select>
        <h4>Address <h4>
        <input type="text" value="{{$data[0][0]->address}}" placeholder="Optional" required name = "address" id ="address" class="form-control">
        <br><button  type="submit" class="btn btn-warning">Update client data</button>
    </form>
        <a href="/deleteUser/{{$data[0][0]->client_id}}" class="btn btn-danger"><i class="fa fa-ban"></i> Delete user(!)</a>
        <h3> Your cars </h3>
    @for($i=0; $i < count($data[0]); $i++)
    <form method="post" action="/updateCar" id="carForm{{$i}}">
        @csrf
        <input type="hidden" value="{{$data[0][$i]->car_id}}" name="car_id" id="car_id">
        <h4>Brand</h4>
        <input type = "text" value="{{$data[0][$i]->brand}}" required name = "brand" id ="brand" class="form-control">
        <h4>Model</h4>
        <input type = "text" value="{{$data[0][$i]->model}}" required name = "model" id ="model" class="form-control">
        <h4>Color</h4>
        <input type = "text" value="{{$data[0][$i]->color}}" required name = "color" id ="color" class="form-control">
        <h4>Licence plate number</h4>
        <input type = "text" value="{{$data[0][$i]->plate_num}}" placeholder="Unique" required name = "plate_num" id ="plate_num" class="form-control">
        <h4>At parking?</h4>
        <select class="form-select" required name="on_parking" id="on_parking">
            <option value="1">In</option>
            <option value="0">Out</option>
        </select>
        <br><button  type="submit" class="btn btn-warning">Update car data</button>
        <hr>
    </form>
    @endfor

    <form method="post" class="bg-6 md-6 sm-6" action="/addCar" id="userForm">
        @csrf
        <h3> New car </h3>
        <h4>Brand</h4>
        <input type = "text" required name = "brand" id ="brand" class="form-control">
        <h4>Model</h4>
        <input type = "text" required name = "model" id ="model" class="form-control">
        <h4>Color</h4>
        <input type = "text" required name = "color" id ="color" class="form-control">
        <h4>Licence plate number</h4>
        <input type = "text" placeholder="Unique" required name = "plate_num" id ="plate_num" class="form-control">
        <h4>At parking?</h4>
        <select class="form-select" name="on_parking" id ="on_parking">
            <option value="1" selected>In</option>
            <option value="0">Out</option>
        </select>    
        <input type="hidden" value="{{$data[0][0]->client_id}}" name="client_id" id="client_id">
        <br><button type="submit" class="btn btn-warning">Add new car</button>
    </form>

@endsection