<?php
namespace App\BusinessLogic;

use App\BusinessLogic\Interfaces\ITweetService;
use App\Enums\ResponseMethodEnum;
use App\Events\TweetNotification;
use App\Http\Requests\Api\TweetRequest;
use App\Http\Resources\Api\Tweet\TweetResource;
use App\Models\Tweet;
use App\Traits\MessageTrait;
use Illuminate\Support\Str;

class TweetService implements ITweetService {

    public function getTimeline($perPage) {
        $user = auth('api')->user();
        $tweets = $user->getPaginatedFollowingTweets($perPage);
        return generalApiResponse(ResponseMethodEnum::CUSTOM_COLLECTION, resource: TweetResource::class, dataPassed: $tweets);
    }

    public function getAll($perPage) {
        $tweets = Tweet::paginate($perPage);
        return generalApiResponse(ResponseMethodEnum::CUSTOM_COLLECTION, resource: TweetResource::class, dataPassed: $tweets);
    }


    public function getOne($slug) {
        $tweet = Tweet::where('slug', $slug)->first();
        if(!$tweet) {
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __('No tweet found'), customStatus: 404, customStatusMsg: 'fail');
        }
        return generalApiResponse(ResponseMethodEnum::CUSTOM_SINGLE, resource: TweetResource::class, dataPassed: $tweet);
    }

    public function store(TweetRequest $request) {
        try {
            // store tweet in database
            auth('api')->user()->tweets()->create($request->validated());
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __('Your tweets has been shared.'), customStatus: 201);
        } catch (\Exception $exp) {
            \Log::error($exp->getMessage());
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __('Something went weong please try again later.'), customStatus: 500);
        }
    }

    public function getUserTweets($perPage) {
        $tweets = auth('api')->user()->tweets()->paginate($perPage);
        return generalApiResponse(ResponseMethodEnum::CUSTOM_COLLECTION, resource: TweetResource::class, dataPassed: $tweets);
    }

    public function delete($id) {

        $tweet = Tweet::find($id);
        if(!$tweet) {
            return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __('No tweet found'), customStatus: 404, customStatusMsg: 'fail');
        }

        $tweet->delete();
        return generalApiResponse(ResponseMethodEnum::CUSTOM, customMessage: __('Tweet deleted successfully'));
    }
}
