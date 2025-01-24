<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function scopeActive(Builder $query)
    {
        //retunn balik query yg dah request kat atas tu
        return $query->where('is_active', true);
    }
}