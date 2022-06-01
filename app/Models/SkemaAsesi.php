<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkemaAsesi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'id' => 'string',
        'skema_id' => 'string',
        'event_id' => 'string',
        'asesi_id' => 'string',
        'asesor_id' => 'string',
    ];

}
