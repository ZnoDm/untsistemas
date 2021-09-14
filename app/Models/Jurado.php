<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurado extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'jurados';
    protected $guarded =[];

    public function tesis(){
        return $this->belongsTo('App\Models\Tesis');
    }

    public function decentes(){
        return $this->belongsTo('App\Models\Docente');
    }
}
