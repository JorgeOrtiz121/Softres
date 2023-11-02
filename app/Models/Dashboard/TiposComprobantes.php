<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class TiposComprobantes extends Model
{
    protected $table = 'tipos_comprobantes';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',

    ];
}