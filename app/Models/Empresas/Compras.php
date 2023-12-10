<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use TenantConnector;

    protected $table = 'compras';
    protected $connection = 'tenant';

    protected $fillable = [
        "tipo_documento",
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function paises(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\Paises','id_pais');
    }
}