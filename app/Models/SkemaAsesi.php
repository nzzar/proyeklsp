<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkemaAsesi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $keyType = 'string';


    protected $casts = [
        'id' => 'string',
        'event_id' => 'string',
        'asesi_id' => 'string',
        'asesor_id' => 'string',
        'admin_id' => 'string'
    ];


    function getTglTtdAsesiAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d',$value)->format('d M Y'); 
        }
        
        return $value;
    }
    
    function getTglTtdAdminAttribute($value)
    {
        if($value) {
            return Carbon::createFromFormat('Y-m-d',$value)->format('d M Y'); 
        }
    }

    public function asesi() {
        return $this->belongsTo(Asesi::class);
    }

    public function event() {
        return $this->belongsTo(Event::class);
    }

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function asesmentMandiri() {
        return $this->hasOne(AsesmentMandiriResult::class);
    }

    public function asesor() {
        return $this->belongsTo(Asesor::class);
    }

    public function ceklisObservasi() {
        return $this->hasMany(CeklisObservasiResult::class)->orderBy('unit_kompetensi');
    }

    public function feedBackNotes() {
        return $this->hasOne(UmpanBalikNote::class, 'skema_asesi_id');
    }

    public function sertifikat() {
        return $this->hasOne(SertifikatAsesi::class, 'skema_asesi_id');
    }

}
