<?php

namespace App\Models;

use App\Models\User;
use App\Models\Label;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    const PRIORITY = [
        'Low' => 'Low',
        'Medium' => 'Medium',
        'High' => 'High',
    ];

    const STATUS = [
        'Open' => 'Open',
        'Closed' => 'Closed',
        'Archived' => 'Archived',
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'is_resolved',
        'comment',
        'assigned_by',
        'assigned_to',
    ];

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }
}