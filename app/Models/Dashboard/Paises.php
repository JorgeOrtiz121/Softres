<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $table = 'paises';
    protected $connection = 'mysql';

    protected $fillable = [
        'codigo_pais',
        'nombre_pais',
        'alfa2',
        'alfa3',
        'indicativo',
        'idioma' 
    ];

}