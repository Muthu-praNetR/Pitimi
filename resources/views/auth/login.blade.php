@extends('layouts.master')

@section('id', 'login-page')
@section('title', trans('messages.login'))

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1>{{ trans('messages.app_name') }}</h1>
                    <h4>{{ trans('messages.app_description')  }}</h4>
                    @include('partials.messages')
                    <hr>
                    {!! Form::open() !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="email">{{ trans('messages.email') }}:</label>
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <label for="password">{{ trans('messages.password') }}:</label>
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('messages.login') }}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
