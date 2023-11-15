<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autorizacion extends Model
{
    protected $table='autorizacionsri';
    protected $connection = 'mysql';
    protected $filliable=['id','autorizacion','autorizacionid'];

    public function opcionautorizacion(){
        return $this->belongsTo(OpcionPago::class);
    }
}
