@extends('pageTemplate')

@section('pageTitle')
    Add client page
@endsection


@section('content')
<h1> Add new Client </h1>
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
    <form method="post" class="bg-6 md-6 sm-6" action="/addClient" id="userForm">
        @csrf
        <h4>Full name <h4> 
        <input type = "text" value="{{old('full_name')}}" placeholder="3 characters min" required name = "full_name" id ="name" class="form-control">
         <h4>Phone number<h4> 
        <input type = "tel" value="{{old('phone_num')}}" placeholder="Format: +78005553535, unique" required name = "phone_num" id ="phone" class="form-control">
        <h4>Gender <h4>
        <select class="form-select" name="gender" id ="gender">
            <option value="1" selected>Male</option>
            <option value="0">Female</option>
        </select>
       <h4>Address <h4>
        <input type = "text" value="{{old('address')}}" placeholder="Optional" required name = "address" id ="address" class="form-control">

        <h3> Your car </h3>
        <h4>Brand</h4>
        <input type = "text" value="{{old('brand')}}" required name = "brand" id ="brand" class="form-control">
        <h4>Model</h4>
        <input type = "text" value="{{old('model')}}" required name = "model" id ="model" class="form-control">
        <h4>Color</h4>
        <input type = "text" value="{{old('color')}}" required name = "color" id ="color" class="form-control">
        <h4>Licence plate number</h4>
        <input type = "text" placeholder="Unique" value="{{old('plate_num')}}" required name = "plate_num" id ="plate_num" class="form-control">
        <h4>At parking?</h4>
        <select class="form-select" name="on_parking" id ="on_parking">
            <option value="1" selected>In</option>
            <option value="0">Out</option>
        </select>
        <br><button  type="submit" class="btn btn-warning">Send your form</button>
    </form>

@endsection