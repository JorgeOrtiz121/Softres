<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class FabricacionArticulo extends Model
{
    protected $table = 'fabricacion_articulo';
    protected $connection = 'mysql';

    protected $fillable = [
        'nombre',
    ];
}
