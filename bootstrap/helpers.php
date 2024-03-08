<?
function tweetNotifications()
{
    return App\Models\TweetNotification::orderBy('id', 'desc')->take(3)->get();
}
