<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TipoDetalles extends Model
{
    protected $table='tipo_detalles';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
    ];

}