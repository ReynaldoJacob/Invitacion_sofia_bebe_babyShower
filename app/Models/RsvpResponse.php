<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RsvpResponse extends Model
{
    protected $fillable = [
        'invitation_id',
        'confirmed_name',
        'attendance',
        'guests_count',
        'companions',
        'responded_at',
    ];

    protected $casts = [
        'guests_count'  => 'integer',
        'responded_at'  => 'datetime',
    ];

    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }
}
