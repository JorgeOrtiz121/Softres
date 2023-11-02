<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class CaducidadArticulo extends Model
{
    use TenantConnector;

    protected $table = 'caducidad_articulo';
    protected $connection = 'tenant';

    protected $fillable = [
        'id_articulo',
        'dias_notificacion',
        'cantidad',
        'fecha_caducidad',
        'lote',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
