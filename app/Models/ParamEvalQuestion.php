<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParamEvalQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'parent_id',
        'ratable_flag',
        'active_flag',
        'sort_order'
    ];
}
