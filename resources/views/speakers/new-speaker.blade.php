@extends('layouts.master')

@section('id', 'new-speaker-page')
@section('title', 'New Speaker')

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        New Speaker
    </h2>
    <form action="{{ route('new-speaker') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <input type="text" class="form-control" name="first_name" placeholder="First Name" autofocus>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
        </div>
        @if(auth()->user()->is_admin)
            <div class="form-group">
                <select class="form-control" name="congregation_id">
                    @foreach($congregations as $congregation)
                        <option value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <a href="{{ route('list-speakers') }}" class="btn btn-default">Cancel</a>
        <button class="btn btn-primary">Save</button>
    </form>
@endsection
