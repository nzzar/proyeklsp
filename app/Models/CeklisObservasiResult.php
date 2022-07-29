<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeklisObservasiResult extends Model
{
    use HasFactory;

    protected $table = 'ceklis_observasi_result';
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];
    
}
