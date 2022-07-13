<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersyaratanSkema extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'persyaratan_skema';
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
        'skema_id' => 'string',
    ];

    public function asesi() {
        return $this->hasOne(PersyaratanAsesi::class, 'persyaratan_id');
    }
}
