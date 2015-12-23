@extends('layouts.master')

@section('id', 'list-speakers-page')
@section('title', 'Speakers')

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        Speakers
    </h2>
    @if($speakers->count() > 0)
        <a href="{{ route('new-speaker') }}" class="btn btn-primary pull-right">Create New Speaker</a>
        {!! $speakers !!}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Congregation</th>
                <th>Prepared Talks</th>
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
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $speakers !!}
        <a href="{{ route('new-speaker') }}" class="btn btn-primary pull-right">Create New Speaker</a>
    @else
        <div class="alert alert-info">
            <i class="fa fa-exclamation"></i>
            There are no speakers.
            <a href="{{ route('new-speaker') }}" class="btn btn-primary">Create New Speaker</a>
        </div>
    @endif
@endsection
