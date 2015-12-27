@extends('layouts.master')

@section('id', 'new-schedule-page')
@section('title', trans('messages.new_schedule'))

@section('content')
    <h2>
        <i class="fa fa-user"></i>
        {{ trans('messages.new_schedule') }}
    </h2>
    <div ng-app="new-schedule">
        {!! Form::open(['ng-controller' => 'NewScheduleCtrl as ctrl', 'ng-cloak' => 'true']) !!}
        {{ csrf_field() }}
        <div class="form-group" ng-if="ctrl.step >= 1">
            <h3>1. {{ trans('messages.select_talk_title') }}</h3>
            <label>{{ trans('messages.talk_subject') }}</label>
            {!! Form::select('talk_id', $talks, null, [
                    'class'       => 'form-control',
                    'autofocus'   => 'autofocus',
                    'ng-model'    => 'ctrl.talkId',
                    'ng-change'   => 'ctrl.talkChanged()',
                    'placeholder' => trans('messages.select_a_talk'),
                ])
            !!}
        </div>
        <div class="form-group" ng-if="ctrl.step >= 2">
            <h3>2. {{ trans('messages.select_available_speaker') }}</h3>
            <label for="speaker_id">{{ trans('messages.available_speakers') }}</label>
            <select name="speaker_id" id="speaker_id" class="form-control"
                    ng-model="ctrl.speakerId"
                    ng-options="speaker as speaker.name for speaker in ctrl.speakers track by speaker.id"
                    ng-disabled="ctrl.speakers.length === 0"
                    ng-change="ctrl.speakerChanged()"></select>
            <div class="alert alert-warning" ng-if="ctrl.speakers.length === 0">
                <i class="fa fa-warning"></i> {{ trans('messages.no_speakers_for_selected_talk') }}.
            </div>
        </div>
        <div class="form-group" ng-if="ctrl.step >= 3">
            <h3>3. {{ trans('messages.confirm_date') }}</h3>
            <label>{{ trans('messages.date') }}</label>
            {!! Form::date('scheduled_at', $date->toDateString(), ['class' => 'form-control']) !!}
        </div>
        <a href="{{ route('calendar') }}" class="btn btn-default">{{ trans('messages.cancel') }}</a>
        <button class="btn btn-primary" type="submit"
                ng-disabled="ctrl.step < 3">{{ trans('messages.save') }}</button>
        {!! Form::close() !!}
    </div>
@endsection

@section('script')
    <script>
        var App = angular.module('new-schedule', []);

        App.controller('NewScheduleCtrl', function () {

            var $this = this;
            var preparedTalksBySpeakers = JSON.parse('{!! addslashes(json_encode($prepared_talks_by_speakers)) !!}');
            var speakers = JSON.parse('{!! addslashes(json_encode($speakers)) !!}');

            // Properties.
            $this.step = 1;
            $this.talkId = null;
            $this.speakerId = null;
            $this.speakers = [];

            // Methods.
            $this.talkChanged = function () {
                if ($this.talkId) {
                    $this.speakers = [];
                    _.each(preparedTalksBySpeakers, function (talks, speakerId) {
                        if (_.contains(talks, +$this.talkId)) {
                            $this.speakers.push({
                                id: +speakerId,
                                name: speakers[speakerId]
                            });
                        }
                    });
                    $this.step = 2;
                    console.log($this.speakers);
                } else {
                    $this.step = 1;
                }
            };

            $this.speakerChanged = function () {
                if ($this.speakerId) {
                    $this.step = 3;
                } else {
                    $this.step = 2;
                }
            }
        });
    </script>
@endsection
