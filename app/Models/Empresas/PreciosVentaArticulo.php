<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class PreciosVentaArticulo extends Model
{
    use TenantConnector;

    protected $table = 'precios_venta_articulo';
    protected $connection = 'tenant';

    protected $fillable = [
        'id_articulo',
        'precio_con_iva',
        'utilidad',
        'ganancia',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
