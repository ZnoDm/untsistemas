<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'avances';
    protected $guarded =[];

    public function tesis(){
        return $this->belongsTo('App\Models\Tesis');
    }
}
