<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CeklisObservasi extends Model
{
    use HasFactory;

    protected $table = 'ceklis_observasi';
    
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
        'asesi_id' => 'string',
        'event_id' => 'string',
        'skema_id' => 'string',
        'unit_kompetensi_id' => 'string',
        'persyaratan_asesi_id' => 'string',
        'element_id' => 'string',
    ];
}
