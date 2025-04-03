<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_id',
        'reported_type',
        'type',
        'reason',
        'status'
    ];

    public function reported()
    {
        return $this->morphTo();
    }

    /**
     * A reporter is a user
     */
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
