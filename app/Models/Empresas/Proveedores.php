<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Proveedores extends Model
{
    use TenantConnector;

    protected $table = 'proveedores';
    protected $connection = 'tenant';

    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombre',
        'razon_social',
        'representante',
        'id_categoria',
        'id_tipos',
        'artesano',
        'id_ubicacion',
        'direccion',
        'telefono',
        'web',
        'email1',
        'email2',
        'id_pais',
        'id_provincia',
        'id_ciudad',
        'cupo_credito',
        'cxp',
        'notas',
        'observaciones',
        'id_subproveedor',
        'id_retencion',
        'retencion_iva_bienes',
        'retencion_iva_servicios',
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function categorias(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\TiposGenerico','id_categoria');
    }

    public function tipos(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\TiposGenerico','id_tipos');
    }

    public function ciudades(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\Ciudades','id_ciudad');
    }

    public function paises(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\Paises','id_pais');
    }

    public function subproveedores(){
        return $this->belongsTo('App\Models\Empresas\Proveedores','id_subproveedor');
    }
}