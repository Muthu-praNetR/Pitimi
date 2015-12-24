<?php

namespace App\Services\Contracts;

use App\Congregation;
use App\Talk;
use App\TalkSubject;
use App\User;

/**
 * The AdminService contract.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
interface AdminService
{
    /**
     * Create a user.
     *
     * @param User $user The user.
     *
     * @return User The created user.
     */
    public function createUser(User $user);

    /**
     * Get a user by id.
     *
     * @param number $id The id of the user.
     *
     * @return User The user.
     */
    public function getUser($id);

    /**
     * Get all users.
     *
     * @param int|number $page_size The page size.
     *
     * @return array Array of users.
     */
    public function getUsers($page_size);

    /**
     * Update a user.
     *
     * @param User $user The user.
     *
     * @return User The updated user.
     */
    public function updateUser(User $user);

    /**
     * Delete a user.
     *
     * @param User $user The user.
     */
    public function deleteUser(User $user);

    /**
     * Create a talk.
     *
     * @param Talk $talk The talk.
     *
     * @return Talk The created talk.
     */
    public function createTalk(Talk $talk);

    /**
     * Get a talk by id.
     *
     * @param number $id The id of the talk.
     *
     * @return Talk The talk.
     */
    public function getTalk($id);

    /**
     * Get all talks.
     *
     * @param int $page_size The page size.
     *
     * @return array Array of talks.
     */
    public function getTalks($page_size = 10);

    /**
     * Update a talk.
     *
     * @param Talk $talk The talk.
     *
     * @return Talk The updated talk.
     */
    public function updateTalk(Talk $talk);

    /**
     * Delete a talk.
     *
     * @param Talk $talk The talk.
     */
    public function deleteTalk(Talk $talk);

    /**
     * Create a talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     *
     * @return TalkSubject The created talk subject.
     */
    public function createTalkSubject(TalkSubject $talk_subject);

    /**
     * Get a talk subject by id.
     *
     * @param number $id The id of the talk subject.
     *
     * @return TalkSubject The talk subject.
     */
    public function getTalkSubject($id);

    /**
     * Get talk subjects.
     *
     * @param number $page_size The page size.
     *
     * @return array [description]
     */
    public function getTalkSubjects($page_size);

    /**
     * Update talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     *
     * @return TalkSubject The updated talk subject.
     */
    public function updateTalkSubject(TalkSubject $talk_subject);

    /**
     * Delete a talk subject.
     *
     * @param TalkSubject $talk_subject The talk subject.
     */
    public function deleteTalkSubject(TalkSubject $talk_subject);

    /**
     * Get all congregations.
     * @return mixed
     */
    public function getAllCongregations();

    /**
     * Get congregations.
     *
     * @param $page_size
     *
     * @return mixed
     */
    public function getCongregations($page_size = 10);

    /**
     * Create a congregation.
     *
     * @param $congregation
     *
     * @return mixed
     */
    public function createCongregation(Congregation $congregation);

    /**
     * Get a congregation by id.
     *
     * @param $id int The id of the congregation.
     *
     * @return mixed A congregation.
     */
    public function getCongregation($id);

    /**
     * Update a congregation.
     *
     * @param $congregation Congregation The congregation.
     *
     * @return Congregation The updated congregation
     */
    public function updateCongregation(Congregation $congregation);
}
