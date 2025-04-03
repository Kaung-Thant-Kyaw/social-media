<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'type',
        'visibility'
    ];

    /**
     * A post belongs to one user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A post can have many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * A post can have multiple media files
     */
    public function media()
    {
        return $this->hasMany(PostMedia::class);
    }

    /**
     * For Post Reaction
     */
    public function reactions()
    {
        return $this->morphMany(Reaction::class, 'reactable');
    }
}
