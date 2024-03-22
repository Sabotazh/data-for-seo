<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataforseo extends Model
{
    use HasFactory;

    protected $fillable = [
        'excluded_target',
        'target_domain',
        'referring_domain',
        'rank',
        'backlinks',
        'parameter',
        'original_response'
    ];
}
