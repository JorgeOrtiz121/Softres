<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Comprobantes extends Model
{
    use TenantConnector;

    protected $table = 'comprobantes';
    protected $connection = 'tenant';

    protected $fillable = [
        'comprobante_id',
        'num_serie1',
        'num_serie2',
        'tipo_comprobante',
        'autorizacion_sri',
        'ultimo_num',
        'fecha_caducidad',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function comprobantes()
    {
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\TiposComprobantes', 'comprobante_id');
    }
}