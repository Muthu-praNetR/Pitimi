@extends('layouts.master')

@section('id', 'list-talks-page')
@section('title', 'Talks')

@section('content')
    <h2>
        <i class="fa fa-file-text-o"></i>
        Talks
    </h2>
    @if($talks->count() > 0)
        <a href="{{ route('new-talk') }}" class="btn btn-primary pull-right">Create New Speaker</a>
        {!! $talks !!}
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Subject</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($talks as $talk)
                <tr>
                    <td>{{ $talk->id }}</td>
                    <td>{{ $talk->number }}</td>
                    <td>
                        @if ($talk->subjects->count() > 0)
                            {{ $talk->subjects->first()->subject }}
                        @else
                            <small class="text-muted"><i class="fa fa-exclamation-triangle"></i> Not Defined</small>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edit-talk', $talk->id) }}">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $talks !!}
        <a href="{{ route('new-talk') }}" class="btn btn-primary pull-right">Create New Speaker</a>
    @else
        <div class="alert alert-info">
            <i class="fa fa-exclamation"></i>
            There are no talks.
            <a href="{{ route('new-talk') }}" class="btn btn-primary">Create New Speaker</a>
        </div>
    @endif
@endsection
