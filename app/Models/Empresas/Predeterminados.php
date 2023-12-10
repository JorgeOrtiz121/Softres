<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Predeterminados extends Model
{
    use TenantConnector;

    protected $table = 'predeterminados';
    protected $connection = 'tenant';

    protected $fillable = [
        'facturas_id',
        'retenciones_id',
        'nota_credito_id',
        'guias_id',
        'liq_compra_id',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function facturas()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'facturas_id');
    }
    public function retenciones()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'retenciones_id');
    }
    public function notas()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'nota_credito_id');
    }
    public function guias()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'guias_id');
    }
    public function liquidaciones()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'liq_compra_id');
    }
}