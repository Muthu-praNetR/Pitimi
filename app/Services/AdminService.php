<?php

namespace App\Services;

use App\Congregation;
use App\Talk;
use App\TalkTitle;
use App\User;
use Auth;

/**
 * The AdminService contract.
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
class AdminService implements Contracts\AdminService
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
     * @param int|number $page_size The page size.
     *
     * @return array Array of users.
     */
    public function getUsers($page_size = 10)
    {
        return User::paginate(10);
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
     * @param int $page_size The page size.
     *
     * @return array Array of talks.
     */
    public function getTalks($page_size = 10)
    {
        $user = Auth::user();
        return Talk::translateTo($user->locale)->paginate($page_size);
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
     * Create a talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     *
     * @return TalkTitle The created talk title.
     */
    public function createTalkTitle(TalkTitle $talk_title)
    {
        // TODO Implement me.
    }

    /**
     * Get a talk title by id.
     *
     * @param number $id The id of the talk title.
     *
     * @return TalkTitle The talk title.
     */
    public function getTalkTitle($id)
    {
        // TODO Implement me.
    }

    /**
     * Get talk titles.
     *
     * @param number $page_size The page size.
     *
     * @return array [description]
     */
    public function getTalkTitles($page_size)
    {
        // TODO Implement me.
    }

    /**
     * Update talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     *
     * @return TalkTitle The updated talk title.
     */
    public function updateTalkTitle(TalkTitle $talk_title)
    {
        // TODO Implement me.
    }

    /**
     * Delete a talk title.
     *
     * @param TalkTitle $talk_title The talk title.
     */
    public function deleteTalkTitle(TalkTitle $talk_title)
    {
        // TODO Implement me.
    }

    /**
     * Get congregations.
     * @return mixed
     */
    public function getAllCongregations()
    {
        return Congregation::all();
    }

    /**
     * Get congregations.
     *
     * @param int $page_size
     *
     * @return mixed
     */
    public function getCongregations($page_size = 10)
    {
        return Congregation::paginate($page_size);
    }

    /**
     * Create a congregation.
     *
     * @param $congregation
     *
     * @return mixed
     */
    public function createCongregation(Congregation $congregation)
    {
        $user = Auth::user();

        $congregation->createdBy()->associate($user);
        $congregation->updatedBy()->associate($user);
        $congregation->save();

        return $congregation;
    }

    /**
     * Get a congregation by id.
     *
     * @param $id int The id of the congregation.
     *
     * @return mixed A congregation.
     */
    public function getCongregation($id)
    {
        $congregation = Congregation::findOrFail($id);
        return $congregation;
    }

    /**
     * Update a congregation.
     *
     * @param $congregation Congregation The congregation.
     *
     * @return Congregation The updated congregation
     */
    public function updateCongregation(Congregation $congregation)
    {
        $original = Congregation::findOrFail($congregation->id);
        $original->name = $congregation->name;
        $original->is_group = $congregation->is_group;
        $original->public_meeting_at = $congregation->public_meeting_at;
        $original->updatedBy()->associate(Auth::user());
        $original->save();

        return $original;
    }


}
