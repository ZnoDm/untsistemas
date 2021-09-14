<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'observations';
    protected $guarded = [];
    //Relacion uno a muchos polimorfica

    public function observationable(){
        return $this->morphTo();
    }
}
