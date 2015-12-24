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
        {!! Form::select('talk', $talks, null, ['class'  => 'form-control', 'autofocus' => 'autofocus']) !!}
    </div>
    <div class="form-group">
        <label>Available Speakers</label>
        <select class="form-control" name="speaker_id"></select>
    </div>
    <div class="form-group">
        <input type="date" class="form-control" value="{{ $date->toDateString() }}">
    </div>
    <a href="{{ route('calendar') }}" class="btn btn-default">Cancel</a>
    <button class="btn btn-primary">Save</button>
    {!! Form::close() !!}
@endsection
