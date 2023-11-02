<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TiposNegocios extends Model
{
    protected $table = 'tipos_negocios';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',

    ];
}