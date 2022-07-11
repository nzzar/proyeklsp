<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitKompetensi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';

    protected $table = 'unit_kompetensi';

    protected $cast  = [
        'id' => 'string',
        'skema_id' => 'string'
    ];

    public function element() {
      return  $this->hasMany(Element::class);
    }

    public function skema() {
      return  $this->belongsTo(Skema::class, 'skema_id', 'id');
    }

    
}
