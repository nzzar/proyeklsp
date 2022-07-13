<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'event';

    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
        'skema_id' => 'string',
    ];

    // protected $dates = [
    //     'start_date',
    //     'end_date'
    // ];

    // getter
    function getStartDateAttribute($value)
    {
        return Carbon::createFromTimeString($value)->format('d/m/Y h:i'); 
    }

    function getEndDateAttribute($value)
    {
        return Carbon::createFromTimeString($value)->format('d/m/Y h:i'); 
    }

    public function skema()
    {
        return $this->belongsTo(Skema::class);
    }

    public function asesi() {
        return $this->hasMany(SkemaAsesi::class);
    }

    public function asesor() {
        return $this->hasMany(SkemaAsesor::class);
    }

}
