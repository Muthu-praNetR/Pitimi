@extends('layouts.master')

@section('id', 'new-speaker-page')
@section('title', 'New Speaker')

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        New Speaker
    </h2>
    {!! Form::open() !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                {!! Form::text('first_name', null, [
                    'class'       => 'form-control',
                    'id'          => 'first_name',
                    'placeholder' => 'First Name',
                    'autofocus'   => 'autofocus',
                    ])
                !!}
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                {!! Form::text('last_name', null, [
                    'class'       => 'form-control',
                    'id'          => 'last_name',
                    'placeholder' => 'Last Name',
                    ])
                !!}
            </div>
            @if(auth()->user()->is_admin)
                <div class="form-group">
                    <label for="congregation_id">Congregation:</label>
                    {!! Form::select('congregation_id', $congregations, null, [
                            'class' => 'form-control',
                            'id'    => 'congregation_id',
                        ])
                    !!}
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label>Select Prepared Talks</label>
                <ul class="talks">
                    @foreach($talks as $key => $value)
                        <li class="talk">
                            {{ $value }}
                            {!! Form::checkbox('talk_ids[]', $value) !!}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <a href="{{ route('list-speakers') }}" class="btn btn-default">Cancel</a>
    <button class="btn btn-primary">Save</button>
    {!! Form::close() !!}
@endsection

@section('script')
    <script>
        jQuery(function ($) {
            $('ul.talks').on('click', 'li', function (event) {
                var $target = $(event.target);
                var $checkbox = $target.find(':checkbox');
                $checkbox.prop('checked', !$checkbox.prop('checked'));
                if ($checkbox.is(':checked')) {
                    $target.addClass('selected');
                } else {
                    $target.removeClass('selected');
                }
            });
        });
    </script>
@endsection
