<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class ParametrosImpresiones extends Model
{
    use TenantConnector;

    protected $table = 'parametros_impresiones';
    protected $connection = 'tenant';

    protected $fillable = [
        'comprobante_id',
        'diseño',
        'impresora',
        'margen_sup',
        'margen_izq',
        'n_copias',
        'copias_hoja',
        'fe_ride',
        'nombre_completo',
    ];
    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function comprobantes()
    {
        return $this->belongsTo('App\Models\Empresas\Comprobantes', 'comprobante_id');
    }

}
