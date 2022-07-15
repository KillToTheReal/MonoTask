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
        <input type = "text" value="{{old('full_name')}}" placeholder="Format: Name Surname Patronymic" required name = "full_name" id ="name" class="form-control">
         <h4>Phone number<h4> 
        <input type = "tel" value="{{old('phone_num')}}" placeholder="Format: +78005553535, unique" required name = "phone_num" id ="phone" class="form-control">
        <h4>Gender <h4>
        <select class="form-select" name="gender" id ="gender">
            <option value="1" selected>Male</option>
            <option value="0">Female</option>
        </select>
       <h4>Address <h4>
        <input type = "text" value="{{old('address')}}" placeholder="Optional" required name = "address" id ="address" class="form-control">

        <h3> Your cars: </h3>
        @if(Null!==(old('formsAmount')))
            @for($i = 0; $i < old('formsAmount'); $i++)
            <h3>Car number {{$i+1}} </h3>
            <h4>Brand</h4>
            <input type = "text" value="{{old('brand')[$i]}}" required name = "brand[]" id ="brand{{$i}}" class="form-control">
            <h4>Model</h4>
            <input type = "text" value="{{old('model')[$i]}}" required name = "model[]" id ="model{{$i}}" class="form-control">
            <h4>Color</h4>
            <input type = "text" value="{{old('color')[$i]}}" required name = "color[]" id ="color{{$i}}" class="form-control">
            <h4>Licence plate number</h4>
            <input type = "text" placeholder="Unique" value="{{old('plate_num')[$i]}}" required name = "plate_num[]" id ="plate_num{{$i}}" class="form-control">
            <h4>At parking?</h4>
            <select class="form-select" name="on_parking[]" id ="on_parking">
                <option value="1" selected>In</option>
                <option value="0">Out</option>
            </select>
            @endfor
        @else 
            <h3>Car number 1 </h3>
            <h4>Brand</h4>
            <input type = "text" value="{{old('brand')}}" required name = "brand[]" id ="brand1" class="form-control">
            <h4>Model</h4>
            <input type = "text" value="{{old('model')}}" required name = "model[]" id ="model1" class="form-control">
            <h4>Color</h4>
            <input type = "text" value="{{old('color')}}" required name = "color[]" id ="color1" class="form-control">
            <h4>Licence plate number</h4>
            <input type = "text" placeholder="Unique" value="{{old('plate_num')}}" required name = "plate_num[]" id ="plate_num1" class="form-control">
            <h4>At parking?</h4>
            <select class="form-select" name="on_parking[]" id ="on_parking1">
                <option value="1" selected>In</option>
                <option value="0">Out</option>
            </select>
        @endif
        <div id="afterForms"></div>
        <input type = "hidden" name="formsAmount" value="1" id="formsAmount">

        <br><button  type="submit" class="btn btn-warning">Send your form</button>
    </form>
    <button class="btn btn-primary" id="adder"> + </button>


    <script>
        var forms = 1;
        var amount = document.getElementById("formsAmount");
        var target = document.getElementById("adder");
        var newForm = document.getElementById("afterForms");
        console.log(target);
        target.addEventListener('click',function()
        {
            forms++;
            newForm.insertAdjacentHTML('beforeend',CarTemplate(forms));
            amount.value = forms;
        });
        function CarTemplate(number){
            return "<h3> Car number "+number+" </h3>"+
            "<h4> Brand </h4><input type = \"text\" id=\"Brand"+number+"\"  required name = \"brand[]\" class=\"form-control\">"+
            "<h4> Model </h4><input type = \"text\" id=\"Model"+number+"\"   required name = \"model[]\" class=\"form-control\">"+
            "<h4> Color </h4><input type = \"text\"  id=\"Color"+number+"\" required name = \"color[]\" class=\"form-control\">"+
            "<h4> License plate number </h4>  <input id=\"License"+number+"\" type = \"text\" required name = \"plate_num[]\" class=\"form-control\">"+
            "<h4>At parking?</h4> <select class=\"form-select\" id=\"on_parking"+number+"\" name=\"on_parking[]\"> <option value=\"1\" selected>In</option><option value=\"0\">Out</option> </select>";
        }
    </script>
@endsection