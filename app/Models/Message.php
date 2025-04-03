<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'group_id',
        'content',
        'read_at'
    ];

    /**
     * A sender -> a user
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * A receiver -> a user
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    /**
     * A message may belongs to a group
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
