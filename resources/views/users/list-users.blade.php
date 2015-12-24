@extends('layouts.master')

@section('id', 'list-users-page')
@section('title', trans('messages.users'))

@section('content')
    <h2>
        <i class="fa fa-cog"></i>
        {{ trans('messages.users') }}
    </h2>
    @if($users->count() > 0)
        {!! $users !!}
        <table class="table">
            <thead>
            <tr>
                <th>{{ trans('messages.id') }}</th>
                <th>{{ trans('messages.first_name') }}</th>
                <th>{{ trans('messages.last_name') }}</th>
                <th>{{ trans('messages.email') }}</th>
                <th>{{ trans('messages.is_admin') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? trans('messages.yes') : trans('messages.no') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $users !!}
    @endif
@endsection
