<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatory extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        
        'signatory_1',
        'signatory_1_pos',

        'signatory_2',
        'signatory_2_pos',

        'signatory_3',
        'signatory_3_pos',

        'signatory_4',
        'signatory_4_pos',
    ];
}
