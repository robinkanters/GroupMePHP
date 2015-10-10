<?php

namespace GroupMePHP;

class GroupMe
{
    public $directmessages;
    public $groups;
    public $likes;
    public $members;
    public $messages;
    public $users;
    public $bots;
    public $sms;
    public $leaderboard;

    public function __construct($token = '')
    {
        if (!isset($token)) {
            die('You must include a user or application token');
        }

        $this->directmessages = new DirectMessages($token);
        $this->groups = new Groups($token);
        $this->likes = new Likes($token);
        $this->members = new Members($token);
        $this->messages = new Messages($token);
        $this->users = new Users($token);
        $this->bots = new Bots($token);
        $this->sms = new Sms($token);
        $this->images = new Images($token);
        $this->leaderboard = new Leaderboard($token);
    }
}
