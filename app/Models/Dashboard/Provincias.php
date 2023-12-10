<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    protected $table='provincias';
    protected $connection = 'mysql';

    protected $fillable = [
        'codigo_provincia',
        'nombre_provincia',
        'pais_id',
    ];

    public static function provincias($id){
        return Provincias::where('pais_id','=',$id)->get();
    }

}