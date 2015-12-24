@extends('layouts.master')

@section('id', 'calendar-page')
@section('title', trans('messages.calendar'))

@section('content')
    <h2>
        <i class="fa fa-calendar"></i>
        {{ trans('messages.calendar') }}
    </h2>

    <div class="toolbar">
        <a href="{{ route('calendar', ['month' => $previous->month, 'year' => $previous->year]) }}"
           class="btn btn-default previous"><i class="fa fa-arrow-left"></i></a>
        <a href="{{ route('calendar', ['month' => $current->month, 'year' => $current->year]) }}"
           class="btn btn-default current">{{ $current->format('F, Y') }}</a>
        <a href="{{ route('calendar', ['month' => $next->month, 'year' => $next->year]) }}"
           class="btn btn-default next"><i class="fa fa-arrow-right"></i></a>
    </div>

    <ul class="calendar">
        @foreach($calendar as $item)
            <li>
                <div class="day {{ $item['inMonth'] ? 'in-month' : 'not-in-month' }}">
                    <span class="date">{{ $item['date']->day }}</span>
                    <a href="{{ route('new-schedule', ['year'=>$item['date']->year, 'month'=>$item['date']->month, 'day'=>$item['date']->day])  }}"
                       class="btn btn-default">{{ trans('messages.schedule_talk') }}</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
