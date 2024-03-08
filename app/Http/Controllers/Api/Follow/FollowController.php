<?php

namespace App\Http\Controllers\Api\Follow;

use App\BusinessLogic\Interfaces\IFollowService;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\MessageTrait;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    private IFollowService $_followService;
    public function __construct(IFollowService $followService) {
        $this->_followService = $followService;
    }
    public function toggleFollow(User $user)
    {
        return $this->_followService->toggleFollow($user);
    }
}
