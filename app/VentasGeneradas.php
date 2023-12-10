<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentasGeneradas extends Model
{
    //
    protected $table='ventas_generadas';
    protected $connection = 'mysql';
    protected $fillable=['id','cliente','tipodoc','subtotal','iva','total','estado'];
}
