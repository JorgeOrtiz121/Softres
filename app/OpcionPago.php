<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionPago extends Model
{
    protected $table='opcionespago';
    protected $connection = 'mysql';
    protected $filliable=['id','nombrepago','pago_id'];
    public function formapago(){
        return $this->belongsTo(FormasPago::class);
    }
}
