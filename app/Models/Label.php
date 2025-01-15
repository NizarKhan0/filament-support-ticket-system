<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $fillable = [
        'name',
        'is_active',
    ];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }
}
