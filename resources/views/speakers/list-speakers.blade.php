@extends('layouts.master')

@section('id', 'list-speakers-page')
@section('title', trans('messages.speakers'))

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        {{ trans('messages.speakers') }}
    </h2>
    @if($speakers->count() > 0)
        <a href="{{ route('new-speaker') }}"
           class="btn btn-primary pull-right">{{ trans('messages.create_new_speaker') }}</a>
        {!! $speakers !!}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('messages.first_name') }}</th>
                <th>{{ trans('messages.last_name') }}</th>
                <th>{{ trans('messages.congregation') }}</th>
                <th>{{ trans('messages.prepared_talks') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($speakers as $speaker)
                <tr>
                    <td>{{ $speaker->id }}</td>
                    <td>{{ $speaker->first_name }}</td>
                    <td>{{ $speaker->last_name }}</td>
                    <td>{{ $speaker->congregation->name }}</td>
                    <td>{{ $speaker->preparedTalks()->count() }}</td>
                    <td>
                        <a href="{{ route('edit-speaker', $speaker->id) }}">
                            <i class="fa fa-pencil"></i> {{ trans('messages.edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $speakers !!}
        <a href="{{ route('new-speaker') }}"
           class="btn btn-primary pull-right">{{ trans('messages.create_new_speaker') }}</a>
    @else
        <div class="alert alert-info">
            <i class="fa fa-exclamation"></i>
            {{ trans('messages.no_speakers') }}.
            <a href="{{ route('new-speaker') }}" class="btn btn-primary">{{ trans('messages.create_new_speaker') }}</a>
        </div>
    @endif
@endsection
