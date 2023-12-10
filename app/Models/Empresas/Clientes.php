<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Clientes extends Model
{
    use TenantConnector;

    protected $table = 'clientes';
    protected $connection = 'tenant';

    protected $fillable = [
        "tipo_documento",
        "parte_relacionada",
        "documento",
        "cod_auxiliar",
        "nombre",
        "razon_social",
        "telefono1",
        "telefono2",
        "id_categoria",
        "id_tipos",
        "direccion",
        "id_ubicacion",
        "id_zona",
        "id_lugar",
        "id_pais",
        "id_provincia",
        "id_ciudad",
        "representante",
        "id_cuenta",
        "puntos",
        "deuda",
        "afavor",
        "email1",
        "email2",
        "credito_max",
        "max_plazo",
        "descuento",
        "intereses_mora",
        "id_estado",
        "id_pvp",
        "observaciones",
        "ref_vivienda",
        "id_sexo",
        "fecha_nacimiento",
        "id_estado_civil",
        "num_hijos",
        "profesion",
        "ingreso_mensual",
        "empresa_lab",
        "referido_por",
        "id_vendedor",
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

    public function provincias(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\Provincias','id_provincia');
    }

    public function paises(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\Paises','id_pais');
    }
}
