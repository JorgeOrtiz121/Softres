<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormasPago extends Model
{
    protected $table='formaspagos';
    protected $connection = 'mysql';
    protected $filliable=['id','formapago'];

    public function opcionpagos(){
        return $this->hasMany(OpcionPago::class,'pago_id');
    }
}
