<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsesmentMandiri extends Model
{
    use HasFactory;

    protected $table = 'asesment_mandiri';

    protected $casts = [
        'id' => 'string',
        'asesi_id' => 'string',
        'event_id' => 'string',
        'skema_id' => 'string',
        'unit_kompetensi_id' => 'string',
        'element_id' => 'string',
    ];
}
