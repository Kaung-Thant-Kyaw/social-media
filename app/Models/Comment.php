<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
        'content'
    ];

    /**
     * A comment belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A comment belongs to a post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * For Comment Reaction
     */
    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }
}
