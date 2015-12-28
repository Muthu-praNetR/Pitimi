<?php

namespace App\Services;

use App\PreparedTalk;
use App\ScheduledTalk;
use App\Speaker;
use App\Talk;
use App\TalkTitle;
use Auth;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Collection;
use Log;

/**
 * The CongregationService class.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class CongregationService implements Contracts\CongregationService
{
    /**
     * Authenticate a user.
     *
     * @param string $email    The email.
     * @param string $password The password.
     *
     * @return bool True if authentication is successful.
     */
    public function authenticate($email, $password)
    {
        Log::debug('authenticate', compact('email'));

        $authenticated = Auth::attempt(['email' => $email, 'password' => $password]);
        $user = Auth::user();

        if ($authenticated) {
            session(['congregation' => $user->is_admin ? null : $user->congregations()->first()]);
            session(['locale' => $user->locale]);
            Log::debug('Authentication successful.', compact('email'));
        } else {
            Log::debug('Authentication failed.', compact('email'));
        }

        return $authenticated;
    }

    /**
     * Logout the current user.
     */
    public function logout()
    {
        Log::debug('logout');
        Auth::logout();
        session_unset();
    }

    /**
     * Create a speaker.
     *
     * @param Speaker $speaker The speaker.
     *
     * @return Speaker The created speaker.
     */
    public function createSpeaker(Speaker $speaker)
    {
        $user = Auth::user();
        $speaker->createdBy()->associate($user);
        $speaker->updatedBy()->associate($user);
        $speaker->save();
        return $speaker;
    }

    /**
     * Get a speaker by id.
     *
     * @param number $id The id of the espeaker.
     *
     * @return Speaker The speaker.
     */
    public function getSpeaker($id)
    {
        return Speaker::with('preparedTalks.talk')
            ->findOrFail($id);
    }

    /**
     * Get speakers.
     *
     * @param int $page_size The page size.
     *
     * @return array Array of speakers.
     */
    public function getSpeakers($page_size = 10)
    {
        if (auth()->user()->is_admin) {
            return Speaker::paginate(10);
        } else {
            return Speaker::where('congregation_id', session('congregation')->id)
                ->paginate(10);
        }
    }

    /**
     * Update a speaker.
     *
     * @param Speaker $speaker The speaker.
     *
     * @return Speaker The updated speaker.
     */
    public function updateSpeaker(Speaker $speaker)
    {
        $original = Speaker::findOrFail($speaker->id);
        $original->first_name = $speaker->first_name;
        $original->last_name = $speaker->last_name;
        $original->congregation_id = $speaker->congregation_id;
        $original->updatedBy()->associate(Auth::user());
        $original->save();
    }

    /**
     * Delete a speaker.
     *
     * @param Speaker $speaker The speaker.
     */
    public function deleteSpeaker(Speaker $speaker)
    {
        // TODO Implement me.
    }

    /**
     * Create a prepared talk.
     *
     * @param TalkTitle $talk_title The talk title.
     * @param Speaker   $speaker    The speaker.
     *
     * @return PreparedTalk The created prepared talk.
     */
    public function createPreparedTalk(TalkTitle $talk_title, Speaker $speaker)
    {
        // TODO Implement me.
    }

    /**
     * Delete a prepared talk.
     *
     * @param PreparedTalk $prepared_talk The prepared talk.
     */
    public function deletePreparedTalk(PreparedTalk $prepared_talk)
    {
        // TODO Implement me.
    }

    /**
     * Schedule a talk.
     *
     * @param integer  $talk_id    The id of the talk.
     * @param integer  $speaker_id The id of the speaker.
     * @param DateTime $date       The date and time.
     *
     * @return ScheduledTalk The scheduled talk.
     */
    public function scheduleTalk($talk_id, $speaker_id, DateTime $date)
    {
        $user = Auth::user();
        $congregation = session('congregation');

        $prepared_talk = PreparedTalk::where('talk_id', $talk_id)
            ->where('speaker_id', $speaker_id)
            ->first();

        $scheduled_talk = new ScheduledTalk();
        $scheduled_talk->congregation()->associate($congregation);
        $scheduled_talk->preparedTalk()->associate($prepared_talk);
        $scheduled_talk->scheduled_at = $date;
        $scheduled_talk->createdBy()->associate($user);
        $scheduled_talk->updatedBy()->associate($user);

        $scheduled_talk->save();

        return $scheduled_talk;
    }

    /**
     * Unschedule a talk.
     *
     * @param ScheduledTalk $scheduled_talk The scheduled talk.
     */
    public function unscheduleTalk(ScheduledTalk $scheduled_talk)
    {
        // TODO Implement me.
    }

    /**
     * View talks in a month.
     *
     * @param DateTime $date The month.
     *
     * @return array Array of days.
     */
    public function viewTalksInMonth(DateTime $date)
    {
        // TODO Implement me.
    }

    /**
     * Get all talks.
     * @return Collection
     */
    public function getAllTalks()
    {
        $user = Auth::user();
        $talks = Talk::with(['titles' => function ($query) use ($user) {
            $query->where('locale_id', $user->locale_id);
        }])->get();

        foreach ($talks as $talk) {
            $talk->titles = $talk->titles->reject(function ($title) use ($user) {
                return $title->locale_id !== $user->locale_id;
            });
        }

        return $talks;
    }

    /**
     * Add one or more prepared talks.
     *
     * @param Speaker $speaker  The speaker.
     * @param array   $talk_ids Array of talk ids.
     *
     * @return Speaker The updated speaker.
     */
    public function addPreparedTalks(Speaker $speaker, $talk_ids)
    {
        $user = Auth::user();
        $prepared_talks = [];
        $talks = Talk::whereIn('id', $talk_ids)->get();

        foreach ($talks as $talk) {
            $prepared_talk = new PreparedTalk();
            $prepared_talk->speaker()->associate($speaker);
            $prepared_talk->talk()->associate($talk);
            $prepared_talk->createdBy()->associate($user);
            $prepared_talk->updatedBy()->associate($user);
            $prepared_talks[] = $prepared_talk;
        }

        PreparedTalk::where('speaker_id', $speaker->id)->delete();
        $speaker->preparedTalks()->saveMany($prepared_talks);
        return $speaker;
    }

    /**
     * Get all speakers.
     * @return array Array of speakers.
     */
    public function getAllSpeakers()
    {
        return Speaker::with('congregation')->get();
    }

    /**
     * Get calendar program for a month
     *
     * @param Carbon $month The month date.
     *
     * @return array A list of days for a calendar month.
     */
    public function getCalendar(Carbon $month)
    {
        $current_month = $month->month;
        $week_start_on = Carbon::MONDAY;

        // Get start and end of calendar month.
        $start = $month->copy()->startOfMonth();
        if ($start->dayOfWeek != $week_start_on) {
            $start->previous($week_start_on);
        }
        $end = $month->copy()->endOfMonth()->next($week_start_on)->subDay();

        // Get public meeting date for selected congregation.
        $congregation = session('congregation');
        $public_meeting_day_of_week = -1;
        if ($congregation) {
            $public_meeting_day_of_week = $congregation->public_meeting_at->dayOfWeek;
        }

        // Get scheduled talks.
        $scheduled_talks = ScheduledTalk::whereBetween('scheduled_at', [$start->endOfDay(), $end->startOfDay()]);
        if ($congregation) {
            $scheduled_talks = $scheduled_talks->inCongregation($congregation);
        }
        $scheduled_talks = $scheduled_talks->get();

        // Generate all calendar month dates.
        $calendar = [];
        $end->addDay();
        $date = $start->copy();
        do {
            $calendar[] = [
                'date'           => $date,
                'in_month'       => $date->month === $current_month,
                'is_meeting'     => $public_meeting_day_of_week === $date->dayOfWeek,
                'is_today'       => $date->isToday(),
                'scheduled_talk' => $scheduled_talks->first(function ($key, $scheduled_talk) use ($date) {
                    return $date->isSameDay($scheduled_talk->scheduled_at);
                })
            ];
            $date = $date->copy()->addDay();
        } while (!$date->isSameDay($end));

        return $calendar;
    }


}
