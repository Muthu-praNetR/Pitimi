@extends('layouts.master')

@section('id', 'new-schedule-page')
@section('title', 'New Schedule')

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        New Schedule
    </h2>
    {!! Form::open() !!}
    {{ csrf_field() }}
    <div class="form-group">
        <label>Talk Subject</label>
        {!! Form::select('talk_id', $talks, null, ['class'  => 'form-control', 'autofocus' => 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label>Available Speakers</label>
        {!! Form::select('speaker_id', $speakers, null, ['class'  => 'form-control']) !!}
    </div>
    <div class="form-group">
        <input type="date" class="form-control" value="{{ $date->toDateString() }}">
    </div>
    <a href="{{ route('calendar') }}" class="btn btn-default">Cancel</a>
    <button class="btn btn-primary">Save</button>
    {!! Form::close() !!}
@endsection
