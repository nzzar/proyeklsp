<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentMandiriResult extends Model
{
    use HasFactory;

    protected $table = 'asesment_mandiri_result';

    protected $keyType = 'string';
    
    protected $casts = [
        'id' => 'string',
        'event_id' => 'string',
        'asesi_id' => 'string',
        'asesor_id' => 'string',
    ];
}
