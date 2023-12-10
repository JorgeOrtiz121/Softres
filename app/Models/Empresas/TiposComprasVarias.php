<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class TiposComprasVarias extends Model
{
    use TenantConnector;

    protected $table = 'tipos_compras_varias';
    protected $connection = 'tenant';

    protected $fillable = [
        'detalle',
        'cuenta_contable',
        'cuenta_contable_iva',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
