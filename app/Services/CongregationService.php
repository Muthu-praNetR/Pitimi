<?php

namespace App\Services;

use App\PreparedTalk;
use App\ScheduledTalk;
use App\Speaker;
use App\Talk;
use App\TalkSubject;
use Auth;
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
            Log::debug('Authentication successful.', compact('email'));

            // Select congregation.
            if (!$user->is_admin) {
                session(['congregation' => $user->congregations()->first()]);
            } else {
                session(['congregation' => null]);
            }
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

        if (!$user->is_admin) {
            $speaker->congregation()->associate($user->congregations->first());
        }

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
     * @param TalkSubject $talk_subject The talk subject.
     * @param Speaker     $speaker      The speaker.
     *
     * @return PreparedTalk The created prepared talk.
     */
    public function createPreparedTalk(TalkSubject $talk_subject, Speaker $speaker)
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
     * @param TalkSubject $talk_subject The talk subject.
     * @param Speaker     $speaker      The speaker.
     * @param DateTime    $date         The date and time.
     *
     * @return ScheduledTalk The scheduled talk.
     */
    public function scheduleTalk(TalkSubject $talk_subject, Speaker $speaker, DateTime $date)
    {
        // TODO Implement me.
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
        $talks = Talk::with(['subjects' => function ($query) use ($user) {
            $query->where('locale_id', $user->locale_id);
        }])->get();

        foreach ($talks as $talk) {
            $talk->subjects = $talk->subjects->reject(function ($subject) use ($user) {
                return $subject->locale_id !== $user->locale_id;
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


}
