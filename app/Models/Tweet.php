<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\{
    Factories\HasFactory,
    Model
};

class Tweet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    // Relationships
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAuthUserLikedTweet() {
        return $this->likes()->where('user_id', auth('api')->user()->id)->exists();
    }
}
