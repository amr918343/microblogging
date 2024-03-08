<?php

namespace App\Http\Controllers\Api\Tweet;

use App\BusinessLogic\Interfaces\ITweetService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaginationRequest;

class TimelineController extends Controller
{
    private ITweetService $_tweetService;

    public function __construct(ITweetService $tweetService)
    {
        $this->_tweetService = $tweetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTimeline(PaginationRequest $request)
    {
        return $this->_tweetService->getTimeline($request->perPage ?? 10);
    }
}
