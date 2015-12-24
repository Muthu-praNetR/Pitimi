@extends('layouts.master')

@section('id', 'edit-congregation-page')
@section('title', trans('messages.edit_congregation'))

@section('content')
    <h2>
        <i class="fa fa-building-o"></i>
        {{ trans('messages.edit_congregation') }}
    </h2>
    {!! Form::model($congregation) !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name">{{ trans('messages.congregation_name') }}</label>
                {!! Form::text('name', null, [
                        'class'       => 'form-control',
                        'id'          => 'name',
                        'placeholder' => trans('messages.name'),
                        'autofocus'   => 'autofocus',
                    ])
                !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="checkbox">
                <label for="is_group">
                    {!! Form::hidden('is_group', 'false') !!}
                    {!! Form::checkbox('is_group', 'true', null, ['id' => 'is_group' ]) !!}
                    {{ trans('messages.is_group') }}
                </label>
            </div>
        </div>
    </div>
    <label for="public_meeting_day_of_week">{{ trans('messages.public_meeting_date_and_time') }}</label>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::select('public_meeting_day_of_week', $days_of_week, $congregation->public_meeting_at->dayOfWeek, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {!! Form::select('public_meeting_time_hour', $hours, $congregation->public_meeting_at->hour, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {!! Form::select('public_meeting_time_minute', $minutes, $congregation->public_meeting_at->minute, ['class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <a href="{{ route('list-congregations') }}" class="btn btn-default">{{ trans('messages.cancel') }}</a>
    <button class="btn btn-primary">{{ trans('messages.save') }}</button>
    {!! Form::close() !!}
@endsection
