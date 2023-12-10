<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class ParametrosGenerales extends Model
{
    use TenantConnector;

    protected $table = 'parametros_generales';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre_id',
        'estado',
        'valor',
        'dato',
    ];
    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function generales()
    {
        return  $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\ParametrosGeneralesAdmin', 'nombre_id');
    }
}
