<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'link_id',
        'status',
    ];

    protected $casts = [
        'type'   => 'string',
        'status' => 'string',
    ];

    /**
     * Genera un link_id único antes de crear la invitación.
     */
    protected static function booted(): void
    {
        static::creating(function (Invitation $invitation) {
            if (empty($invitation->link_id)) {
                do {
                    $token = Str::random(10);
                } while (static::where('link_id', $token)->exists());

                $invitation->link_id = $token;
            }
        });
    }

    public function rsvpResponse()
    {
        return $this->hasOne(RsvpResponse::class);
    }
}
