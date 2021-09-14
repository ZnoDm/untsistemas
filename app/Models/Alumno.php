<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $primaryKey = 'codigo';
    protected $guarded = [];
    public $timestamps = false;
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function docentes(){
        return $this->belongsToMany('App\Models\Docente');
    }

    public function practicas(){
        return $this->belongsToMany('App\Models\Practica');
    }
    
    public function tesis(){
        return $this->belongsToMany('App\Models\Tesis');
    }

    //Relacion uno a muchos polimorfica
    public function comments(){
        return $this->morphMany('App\Models\Comment','commentable');
    }
}
