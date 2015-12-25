@extends('layouts.master')

@section('id', 'calendar-page')
@section('title', trans('messages.calendar'))

@section('content')
    <h2>
        <i class="fa fa-calendar"></i>
        {{ trans('messages.month'.$current->month) }}
        {{ $current->format('Y') }}
    </h2>

    <div class="toolbar">
        <a href="{{ route('calendar', ['month' => $previous->month, 'year' => $previous->year]) }}"
           class="btn btn-default previous"><i class="fa fa-arrow-left"></i></a>
        <a href="{{ route('calendar', ['month' => $today->month, 'year' => Carbon\Carbon::now()->year]) }}"
           class="btn btn-default">{{ trans('messages.today') }}</a>
        <a href="{{ route('calendar', ['month' => $next->month, 'year' => $next->year]) }}"
           class="btn btn-default next"><i class="fa fa-arrow-right"></i></a>
    </div>

    <ul class="calendar">
        @foreach($days_of_week as $day_of_week)
            <li><strong>{{ $day_of_week }}</strong></li>
        @endforeach
        @foreach($calendar as $item)
            <li>
                <div class="day {{ $item['in_month'] ? 'in-month' : 'not-in-month' }} {{ $item['is_meeting'] ? 'is-meeting' : 'is-not-meeting' }} {{ $item['is_today'] ? 'is-today' : 'is-not-today' }}">
                    <span class="date">{{ $item['date']->day }}</span>
                    @if($item['scheduled_talk'])
                        <span class="badge badge-default">#{{ $item['scheduled_talk']->preparedTalk->talk->number }}</span>
                    @else
                        <a href="{{ route('new-schedule', ['year'=>$item['date']->year, 'month'=>$item['date']->month, 'day'=>$item['date']->day])  }}"
                           class="btn btn-default btn-xs">{{ trans('messages.schedule_talk') }}</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
@endsection
