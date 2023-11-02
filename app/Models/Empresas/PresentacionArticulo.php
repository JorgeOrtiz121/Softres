<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class PresentacionArticulo extends Model
{
    use TenantConnector;

    protected $table = 'presentacion_articulo';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre',
        'abreviatura',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
