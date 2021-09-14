<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tesis extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tesis';
    protected $guarded =[];

    public function alumnos(){
        return $this->belongsToMany('App\Models\Alumno');
    }

    public function jurados(){
        return $this->hasMany('App\Models\Jurado');
    }

    public function voucher(){
        return $this->belongsTo('App\Models\Voucher');
    }
    //Relacion uno a muchos polimorfica
    public function observations(){
        return $this->morphMany('App\Models\Observation','observationable');
    }
}
