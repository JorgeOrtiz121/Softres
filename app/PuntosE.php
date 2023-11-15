<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntosE extends Model
{
    protected $table='puntosdeemision';
    protected $connection = 'mysql';
    protected $filliable=['id','emision'];

    public function opcionemisions(){
        return $this->hasMany(Autorizacion::class,'autorizacionid');
    }
}
