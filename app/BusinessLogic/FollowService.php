<?php
namespace App\BusinessLogic;

use App\Enums\ResponseMethodEnum;
use App\Events\TweetNotification;
use App\Http\Requests\Api\TweetRequest;
use App\Traits\MessageTrait;
use Illuminate\Support\Str;

use App\BusinessLogic\Interfaces\{
    IFollowService,
    INotificationService,
    ITweetService
};
use App\Models\{
    Tweet,
    TweetNotification as Notification
};

class FollowService implements IFollowService {
    public function toggleFollow($followed) {
        if($followed->id == auth('api')->id()) {
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __("You cannot follow yourself"), customStatusMsg: 'fail', customStatus: 422);
        }
        $user = auth('api')->user();
        $followStatus = '';

        if ($user->followings()->where('following_id', $followed->id)->exists()) {
            $user->followings()->detach($followed->id);
            $followStatus = 'unfollowed';
        } else {
            $user->followings()->syncWithoutDetaching($followed->id);
            $followStatus = 'followed';
        }

        return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __($followStatus, ['username' => $followed->username]));
    }
}
