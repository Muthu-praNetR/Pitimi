@extends('layouts.master')

@section('id', 'list-congregations-page')
@section('title', 'Congregations')

@section('content')
    <h2>
        <i class="fa fa-building-o"></i>
        Congregations
    </h2>
    @if($congregations->count() > 0)
        <a href="{{ route('new-congregation') }}" class="btn btn-primary pull-right">Create New Congregation</a>
        {!! $congregations !!}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Is Group?</th>
                <th>Public Meeting Date and Time</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($congregations as $congregation)
                <tr>
                    <td>{{ $congregation->id }}</td>
                    <td>{{ $congregation->name }}</td>
                    <td>{{ $congregation->is_group ? 'Yes' : 'No' }}</td>
                    <td>
                        Every
                        {{ $congregation->public_meeting_at->format('l') }}
                        at
                        {{ $congregation->public_meeting_at->format('h:i A') }}
                    </td>
                    <td>
                        <a href="{{ route('edit-congregation', $congregation->id) }}">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $congregations !!}
        <a href="{{ route('new-congregation') }}" class="btn btn-primary pull-right">Create New Congregation</a>
    @else
        <div class="alert alert-info">
            <i class="fa fa-exclamation"></i>
            There are no congregations.
            <a href="{{ route('new-congregation') }}" class="btn btn-primary">Create New Congregation</a>
        </div>
    @endif
@endsection
