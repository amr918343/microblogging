<?php
namespace App\BusinessLogic\Interfaces;

use App\Http\Requests\Api\TweetRequest;

interface ITweetService {
    public function getTimeline($perPage);
    public function getAll($page_counter);
    public function getOne($slug);
    public function store(TweetRequest $request);
    public function getUserTweets($page_counter);
    // public function update(TweetRequest $request, $id);
    public function delete($id);
}
