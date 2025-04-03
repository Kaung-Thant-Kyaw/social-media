<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'privacy',
    ];

    /**
     * A user who created group
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Group has many group members
     */
    public function members()
    {
        return $this->hasMany(GroupMember::class);
    }

    /**
     * messages in group
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
