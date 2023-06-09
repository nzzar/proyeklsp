<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmpanBalik extends Model
{
    use HasFactory;

    protected $table = 'umpan_balik';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];

}
