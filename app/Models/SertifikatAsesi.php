<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SertifikatAsesi extends Model
{
    use HasFactory;

    protected $table = 'sertifikat_asesi';
    protected $keyType = 'string';

    protected $casts = [
        'id' => 'string',
        'skema_asesi_id' => 'string'
    ];

    public function skemaAsesi() {
        return $this->belongsTo(SkemaAsesi::class, 'skema_asesi_id');
    }
}
