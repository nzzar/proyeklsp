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
}
