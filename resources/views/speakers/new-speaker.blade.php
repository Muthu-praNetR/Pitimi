@extends('layouts.master')

@section('id', 'new-speaker-page')
@section('title', trans('messages.new_speaker'))

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        {{ trans('messages.new_speaker') }}
    </h2>
    {!! Form::open() !!}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="first_name">{{ trans('messages.first_name') }}:</label>
                {!! Form::text('first_name', null, [
                    'class'       => 'form-control',
                    'id'          => 'first_name',
                    'placeholder' => trans('messages.first_name'),
                    'autofocus'   => 'autofocus',
                    ])
                !!}
            </div>
            <div class="form-group">
                <label for="last_name">{{ trans('messages.last_name') }}:</label>
                {!! Form::text('last_name', null, [
                    'class'       => 'form-control',
                    'id'          => 'last_name',
                    'placeholder' => trans('messages.last_name'),
                    ])
                !!}
            </div>
            <div class="form-group">
                <label for="email">{{ trans('messages.email') }}:</label>
                {!! Form::text('last_name', null, [
                    'class'       => 'form-control',
                    'id'          => 'email',
                    'placeholder' => trans('messages.email'),
                    ])
                !!}
            </div>
            @if(auth()->user()->is_admin)
                <div class="form-group">
                    <label for="congregation_id">{{ trans('messages.congregation') }}:</label>
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
                <label>{{ trans('messages.select_prepared_talks') }}</label>
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

    <a href="{{ route('list-speakers') }}" class="btn btn-default">{{ trans('messages.cancel') }}</a>
    <button class="btn btn-primary">{{ trans('messages.save') }}</button>
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
