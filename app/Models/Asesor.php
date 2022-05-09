<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
