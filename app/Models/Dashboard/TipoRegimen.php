<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TipoRegimen extends Model
{
    protected $table='tipo_regimens';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
    ];

}
