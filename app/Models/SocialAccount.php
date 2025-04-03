<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = [
        'user_id',
        'provider',
        'provider_id',
        'token',
        'refresh_token',
        'expired_at'
    ];

    // relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
