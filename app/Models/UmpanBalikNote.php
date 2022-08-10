<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmpanBalikNote extends Model
{
    use HasFactory;

    protected $table = 'umpan_balik_notes';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];
}
