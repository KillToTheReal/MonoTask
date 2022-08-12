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

@endsection