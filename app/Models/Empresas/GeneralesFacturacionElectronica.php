<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class GeneralesFacturacionElectronica extends Model
{
    use TenantConnector;

    protected $table = 'parametros_fe_comprobante_correo';
    protected $connection = 'tenant';

    protected $fillable = [
        'facturas_cbte_venta',
        'retencion_compras',
        'guias_remision',
        'notas_credito',
        'decimales_factura',
    ];
    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

}