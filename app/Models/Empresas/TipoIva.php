<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class TipoIva extends Model
{
    use TenantConnector;

    protected $table = 'tipo_iva';
    protected $connection = 'tenant';

    protected $fillable = [
        "procentaje",
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

}
