@extends('layouts.master')

@section('id', 'login-page')
@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>Pitimi</h1>
                    <h4>Public Talk Manager</h4>
                    <hr>
                    <form method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
