<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class ParametrosGeneralesAdmin extends Model
{
    protected $table = 'parametros_generales';
    protected $connection = 'mysql';

    protected $fillable = [
        'modulo',
        'nombre',
        'estado',
        'valor',
        'dato',
    ];
}