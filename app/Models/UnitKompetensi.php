<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Element;

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

    public function elemet() {
        $this->belongsTo(Element::class);
    }

    
}
