<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeninjauAsesment extends Model
{
    use HasFactory;

    protected $table = 'meninjau_instrument';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];
}
