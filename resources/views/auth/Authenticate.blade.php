@extends('layouts.app')
@section('title') <title>Login</title>@endsection
@section('content')
    <br>
    <div class="container col-md-4 background-white" style="padding-bottom: 15px; border-radius: 10px;">
        <h1>Log in</h1>
        <hr/>

        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session()->get('message') }}
            </div>
        @endif

        {{ Form::open(array('action' => 'AuthController@login', 'method' => 'post')) }}
            {{ csrf_field() }}
            <div class="form-group col-md-12">
                <label>Username: </label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
        </br>
            <div class="form-group col-md-12">
                <label>Password: </label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
        <hr/>
        {{ Form::submit('Volgende',['class' => 'btn btn-primary form-control mb-12 ']) }}
        <a href="{{ route('showreset')}}">Forgot password</a>
        {{ Form::close() }}
        </div>
    </div>
@endsection()