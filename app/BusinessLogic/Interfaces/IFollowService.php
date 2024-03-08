<?php
namespace App\BusinessLogic\Interfaces;

use App\Http\Requests\Api\TweetRequest;

interface IFollowService {
    public function     toggleFollow($userID);
}
