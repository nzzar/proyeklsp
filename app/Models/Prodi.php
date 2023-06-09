<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prodi extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    
    protected $casts = [
        'id' => 'string',
        'user_id' => 'string'
    ];

    protected $keyType = 'string';

    public function asesi() {
        return $this->hasMany(Asesi::class);
    }
}
