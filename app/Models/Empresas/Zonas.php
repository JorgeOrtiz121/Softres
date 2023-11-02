<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Zonas extends Model
{
    use TenantConnector;

    protected $table = 'zonas';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre',
        'descripcion',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }
}
