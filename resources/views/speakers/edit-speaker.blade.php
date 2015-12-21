@extends('layouts.master')

@section('id', 'edit-speaker-page')
@section('title', 'Edit Speaker')

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        Edit Speaker
    </h2>
    <form action="{{ route('edit-speaker', $speaker->id) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="first_name" placeholder="First Name" autofocus
                   value="{{ $speaker->first_name }}">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="last_name" placeholder="Last Name"
                   value="{{ $speaker->last_name }}">
        </div>
        <a href="{{ route('list-speakers') }}" class="btn btn-default">Cancel</a>
        <button class="btn btn-primary">Save</button>
    </form>
@endsection
