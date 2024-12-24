<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'title',
        'particulars',

        'start_date',
        'start_time',
        'end_time',
        'end_date',

        'reg_start_date',
        'reg_end_date',
        'reg_start_time',
        'reg_end_time',
        
        'no_of_participants',
        'status',
        'created_by',
        'certificate_id',
        'evaluation_id'

    ];
}
