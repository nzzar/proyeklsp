<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersetujuanAsesmen extends Model
{
    use HasFactory;

    protected $table = 'persetujuan_asesmen';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];
}
