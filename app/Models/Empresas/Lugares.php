<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Lugares extends Model
{
    use TenantConnector;

    protected $table = 'lugares';
    protected $connection = 'tenant';

    protected $fillable = [
        'nombre',
        'descripcion',
        'id_zona',

    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function zonas()
    {
        return $this->belongsTo('App\Models\Empresas\Zonas', 'id_zona');
    }
}
