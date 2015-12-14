<?php

use App\User;
use App\Talk;

/**
 * The AdminService contract.
 *
 * @author Rubens Mariuzzo <rubens@mariuzzo.com>
 */
interface AdminService
{
    public function createUser(User $user);
    public function getUser($id);
    public function getUsers();
    public function updateUser(User $user);
    public function deleteUser(User $user);

    public function createTalk(Talk $talk);
    public function getTalk($id);
    public function getTalks();
    public function updateTalk(Talk $talk);
    public function deleteTalk(Talk $talk);

    public function createTalkSubject(TalkSubject $talkSubject);
    public function getTalkSubject($id);
    public function getTalkSubjects();
    public function updateTalkSubject(TalkSubject $talkSubject);
    public function deleteTalkSubject(TalkSubject $talkSubject);
}
