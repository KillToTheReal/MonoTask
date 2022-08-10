@extends('pageTemplate')

@section('pageTitle')
    Add car page
@endsection


@section('content')
<h1> Add new car </h1>
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
    <div id="app">
        <addcar-form :clients="{{json_encode($cl)}}"></addcar-form>
    </div>

    <form method="post" class="bg-6 md-6 sm-6" action="/addCar" id="userForm">
        @csrf
        <h3> New car </h3>
        <h4>Brand</h4>
        <input type = "text" value="{{old('brand')}}" required name = "brand" id ="brand" class="form-control">
        <h4>Model</h4>
        <input type = "text" value="{{old('model')}}" required name = "model" id ="model" class="form-control">
        <h4>Color</h4>
        <input type = "text" value="{{old('color')}}" required name = "color" id ="color" class="form-control">
        <h4>Licence plate number</h4>
        <input type = "text" value="{{old('plate_num')}}" placeholder="Unique" required name = "plate_num" id ="plate_num" class="form-control">
        <h4>At parking?</h4>
        <select class="form-select" name="on_parking" id ="on_parking">
            <option value="1" selected>In</option>
            <option value="0">Out</option>
        </select>
        <h4> Owner </h4>
        <select class="form-select" name="client_id" id="client_id">
            @foreach($cl as $client)
                <option value="{{$client->client_id}}">{{$client->full_name}} - ID:{{$client->client_id}} </option>
            @endforeach
        </select>
        <br><button type="submit" class="btn btn-warning">Send your form</button>
    </form>

@endsection