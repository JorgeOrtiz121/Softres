<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class UbicacionArticulo extends Model
{
    use TenantConnector;

    protected $table = 'ubicacion_articulo';
    protected $connection = 'tenant';

    protected $fillable = [
        'id_articulo',
        'estante',
        'lado',
        'fila',
        'columna',
        'adicional',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
