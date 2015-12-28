<?php

namespace App\Services\Contracts;

use App\Congregation;
use App\Talk;
use App\TalkTitle;
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
     * Create a talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     *
     * @return TalkTitle The created talk title.
     */
    public function createTalkTitle(TalkTitle $talk_title);

    /**
     * Get a talk title by id.
     *
     * @param number $id The id of the talk title.
     *
     * @return TalkTitle The talk title.
     */
    public function getTalkTitle($id);

    /**
     * Get talk titles.
     *
     * @param number $page_size The page size.
     *
     * @return array [description]
     */
    public function getTalkTitles($page_size);

    /**
     * Update talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     *
     * @return TalkTitle The updated talk title.
     */
    public function updateTalkTitle(TalkTitle $talk_title);

    /**
     * Delete a talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     */
    public function deleteTalkTitle(TalkTitle $talk_title);

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
