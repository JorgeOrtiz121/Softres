<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{

    protected $table='ciudades';
    protected $connection = 'mysql';

    protected $fillable = [
        'codigo_ciudad',
        'nombre_ciudad',
        'provincia_id',
    ];  

    public static function ciudades($id){
        return Ciudades::where('provincia_id','=',$id)->get();
    }

}