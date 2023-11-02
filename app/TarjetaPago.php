<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TarjetaPago extends Model
{
    //
    protected $table='tarjetaspago';
    protected $connection = 'mysql';
    protected $filliable=['id','tipotarjeta'];
}
