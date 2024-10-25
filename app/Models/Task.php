<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'status',
        'priority',
        'completed',
        'user_id',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
