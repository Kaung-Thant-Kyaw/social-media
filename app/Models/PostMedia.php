<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostMedia extends Model
{
    protected $fillable = [
        'post_id',
        'file_path',
        'media_type',
        'order'
    ];

    /**
     * Post Media belongs to a post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
