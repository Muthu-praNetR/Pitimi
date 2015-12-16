<?php

namespace App\Services;

use App\Speaker;
use App\TalkSubject;
use App\PreparedTalk;
use App\ScheduledTalk;
use Auth;
use DateTime;
use Log;

/**
 * The CongregationService class.
 *
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

        if ($authenticated) {
            Log::debug('Authentication successful.', compact('email'));
        } else {
            Log::debug('Authentication failed.', compact('email'));
        }

        return $authenticated;
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
        // TODO Implement me.
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
        // TODO Implement me.
    }

    /**
     * Get speakers.
     *
     * @param number $page_size The page size.
     *
     * @return array Array of speakers.
     */
    public function getSpeakers($page_size)
    {
        // TODO Implement me.
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
        // TODO Implement me.
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
}
