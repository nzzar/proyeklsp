<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skema extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string',
    ];

    public function unitKompetensi() {
      return  $this->hasMany(UnitKompetensi::class);
    }

    public function persyaratan() {
        return $this->hasMany(PersyaratanSkema::class, 'skema_id', 'id');
    }

    public function element() {
        return $this->hasManyThrough(Element::class, UnitKompetensi::class, 'skema_id', 'unit_kompetensi_id', 'id');
    }

}
