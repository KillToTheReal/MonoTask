@extends('pageTemplate')

@section('pageTitle')
    Update Client data
@endsection

@section('content')
    <div id="app">
        <updateuser-form :mydata="{{json_encode($data)}}"></updateuser-form>
        <addcarinclient-form :mydata="{{json_encode($data)}}"></addcarinclient-form>
    </div>
@endsection

