@extends('layouts.master')

@section('id', 'list-congregations-page')
@section('title', trans('messages.congregations'))

@section('content')
    <h2>
        <i class="fa fa-building-o"></i>
        {{ trans('messages.congregations') }}
    </h2>
    @if($congregations->count() > 0)
        <a href="{{ route('new-congregation') }}"
           class="btn btn-primary pull-right">{{ trans('messages.create_new_congregation') }}</a>
        {!! $congregations !!}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>{{ trans('messages.name') }}</th>
                <th>{{ trans('messages.is_group') }}</th>
                <th>{{ trans('messages.public_meeting_date_and_time') }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($congregations as $congregation)
                <tr>
                    <td>{{ $congregation->id }}</td>
                    <td>{{ $congregation->name }}</td>
                    <td>{{ $congregation->is_group ? trans('messages.yes') : trans('messages.no') }}</td>
                    <td>
                        <span class="text-muted">{{ trans('messages.every') }}</span>
                        {{ trans('messages.'. strtolower($congregation->public_meeting_at->format('l'))) }}
                        <span class="text-muted">{{ trans('messages.at') }}</span>
                        {{ $congregation->public_meeting_at->format('h:i A') }}
                    </td>
                    <td>
                        <a href="{{ route('edit-congregation', $congregation->id) }}">
                            <i class="fa fa-pencil"></i> {{ trans('messages.edit') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $congregations !!}
        <a href="{{ route('new-congregation') }}"
           class="btn btn-primary pull-right">{{ trans('messages.create_new_congregation') }}</a>
    @else
        <div class="alert alert-info">
            <i class="fa fa-exclamation"></i>
            {{ trans('messages.no_congregations') }}.
            <a href="{{ route('new-congregation') }}"
               class="btn btn-primary">{{ trans('messages.create_new_congregation') }}</a>
        </div>
    @endif
@endsection
