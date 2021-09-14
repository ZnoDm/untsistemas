<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'practicas';
    protected $guarded =[];


    public function voucher(){
        return $this->belongsTo('App\Models\Voucher');
    }

    public function empresa(){
        return $this->belongsTo('App\Models\Empresa');
    }

    public function alumnos(){
        return $this->belongsToMany('App\Models\Alumno');
    }

    //Relacion uno a muchos polimorfica
    public function observations(){
        return $this->morphMany('App\Models\Observation','observationable');
    }
}
