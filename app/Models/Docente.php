<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $table = 'docentes';
    protected $guarded = [];
    public $timestamps = false;

    public function alumnos(){
        return $this->belongsToMany('App\Models\Alumno');
    }

    public function jurados(){
        return $this->hasMany('App\Models\Jurado');
    }
}
