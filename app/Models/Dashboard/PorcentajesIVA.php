<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class PorcentajesIVA extends Model
{

    protected $table = 'porcentajes_iva';
    protected $connection = 'mysql';

    protected $fillable = [
        'porcentaje',
    ];
}
