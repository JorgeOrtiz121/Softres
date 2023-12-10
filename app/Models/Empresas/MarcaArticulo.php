<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class MarcaArticulo extends Model
{
    use TenantConnector;

    protected $table = 'marca_articulo';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
