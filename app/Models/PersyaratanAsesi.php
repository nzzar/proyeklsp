<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersyaratanAsesi extends Model
{
    use HasFactory;

    protected $table = 'persyaratan_asesi';
    protected $casts = [
        'id' => 'string',
        'skema_id' => 'string',
        'event_id' => 'string'
    ];
}
