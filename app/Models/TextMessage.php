<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;


class TextMessage extends Model
{
    protected $fillable = [
        'message',
        'response_payload',
        'status',
        'remarks',
        'send_by',
        'send_to',
    ];

    const STATUS = [
        'PENDING' => 'PENDING',
        'SUCCESS' => 'SUCCESS',
        'FAILED' => 'FAILED',
    ];

    public function sentBy()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }
    public function sentTo()
    {
        return $this->belongsTo(User::class, 'sent_to');
    }

}