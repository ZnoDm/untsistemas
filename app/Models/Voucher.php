<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $guarded =[];
    public $timestamps = false;
    
    public function practica(){
        return $this->hasOne('App\Models\Practica');
    }

    public function tesis(){
        return $this->hasOne('App\Models\Tesis');
    }
    
}
