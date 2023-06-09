<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asesi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'id' => 'string',
        'user_id' => 'string',
        'prodi_id' => 'string',
    ];

    protected $keyType = 'string';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function prodi() {
        return $this->belongsTo(Prodi::class);
    }

    function getBirthDateAttribute($value)
    {
        if($value != null ) {
            return Carbon::createFromFormat('Y-m-d', $value)->format('d M Y'); 
        }
    }
}
