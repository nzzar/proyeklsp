<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Element extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'element';
    protected $keyType = 'string';

    protected $cast  = [
        'id' => 'string',
        'unit_kompetensi_id' => 'string'
    ];

    public function unjukKerja() {
        return $this->hasMany(UnjukKerja::class);
    }

    public function asesi() {
        return $this->hasOne(AsesmentMandiri::class, 'element_id');
    }

}
