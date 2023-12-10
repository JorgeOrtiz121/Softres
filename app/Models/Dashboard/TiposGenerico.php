<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TiposGenerico extends Model
{
    protected $table='tipos_genericos';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
        'id_tipo'
    ];

}