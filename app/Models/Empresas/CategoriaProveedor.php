<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class CategoriaProveedor extends Model
{
    use TenantConnector;

    protected $table = 'categoria_proveedor';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

}