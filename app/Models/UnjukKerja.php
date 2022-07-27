<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnjukKerja extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';

    protected $table = 'unjuk_kerja';

    protected $cast  = [
        'id' => 'string',
        'element_id' => 'string'
    ];

    public function asesi() {
        return $this->hasOne(CeklisObservasi::class);
    }

    public function element() {
        return $this->belongsTo(Element::class, 'element_id');
    }

}
