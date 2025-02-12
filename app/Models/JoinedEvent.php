<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinedEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'event_code',
        'created_by'
    ];
}
