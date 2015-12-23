@extends('layouts.master')

@section('id', 'list-users-page')
@section('title', 'Users')

@section('content')
    <h2>
        <i class="fa fa-cog"></i>
        Users
    </h2>
    @if($users->count() > 0)
        {!! $users  !!}
        <table class="table">
            <thead>
            <tr>
                <th>id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>E-Mail</th>
                <th>Is Admin?</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $users  !!}
    @endif
@endsection
