<?php

namespace App\Services\Contracts;

use App\User;
use App\Talk;

/**
 * The AdminService contract.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class AdminService extends Contracts\AdminService
{
    /**
     * Create a user.
     *
     * @param User $user The user.
     *
     * @return User The created user.
     */
    public function createUser(User $user)
    {
        // TODO Implement me.
    }

    /**
     * Get a user by id.
     *
     * @param number $id The id of the user.
     *
     * @return User The user.
     */
    public function getUser($id)
    {
        // TODO Implement me.
    }

    /**
     * Get all users.
     *
     * @param number $page_size The page size.
     *
     * @return array Array of users.
     */
    public function getUsers($page_size)
    {
        // TODO Implement me.
    }

    /**
     * Update a user.
     *
     * @param User $user The user.
     *
     * @return User The updated user.
     */
    public function updateUser(User $user)
    {
        // TODO Implement me.
    }

    /**
     * Delete a user.
     *
     * @param User $user The user.
     */
    public function deleteUser(User $user)
    {
        // TODO Implement me.
    }

    /**
     * Create a talk.
     *
     * @param Talk $talk The talk.
     *
     * @return Talk The created talk.
     */
    public function createTalk(Talk $talk)
    {
        // TODO Implement me.
    }

    /**
     * Get a talk by id.
     *
     * @param number $id The id of the talk.
     *
     * @return Talk The talk.
     */
    public function getTalk($id)
    {
        // TODO Implement me.
    }

    /**
     * Get all talks.
     *
     * @param number $page_size The page size.
     *
     * @return array Array of talks.
     */
    public function getTalks($page_size)
    {
        // TODO Implement me.
    }

    /**
     * Update a talk.
     *
     * @param Talk $talk The talk.
     *
     * @return Talk The updated talk.
     */
    public function updateTalk(Talk $talk)
    {
        // TODO Implement me.
    }

    /**
     * Delete a talk.
     *
     * @param Talk $talk The talk.
     */
    public function deleteTalk(Talk $talk)
    {
        // TODO Implement me.
    }

    /**
     * Create a talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     *
     * @return TalkSubject The created talk subject.
     */
    public function createTalkSubject(TalkSubject $talk_subject)
    {
        // TODO Implement me.
    }

    /**
     * Get a talk subject by id.
     *
     * @param number $id The id of the talk subject.
     *
     * @return TalkSubject The talk subject.
     */
    public function getTalkSubject($id)
    {
        // TODO Implement me.
    }

    /**
     * Get talk subjects.
     *
     * @param number $page_size The page size.
     *
     * @return array [description]
     */
    public function getTalkSubjects($page_size)
    {
        // TODO Implement me.
    }

    /**
     * Update talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     *
     * @return TalkSubject The updated talk subject.
     */
    public function updateTalkSubject(TalkSubject $talk_subject)
    {
        // TODO Implement me.
    }

    /**
     * Delete a talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     */
    public function deleteTalkSubject(TalkSubject $talk_subject)
    {
        // TODO Implement me.
    }
}
