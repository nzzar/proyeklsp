<?php

namespace App\Models;

use Carbon\Carbon;
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

    function getBirthDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'); 
    }

    function getStartDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'); 
    }

    function getExpiredDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y'); 
    }
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    
}
