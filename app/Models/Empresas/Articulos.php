<?php

namespace App\Models\Empresas;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TenantConnector;

class Articulos extends Model
{
    use TenantConnector;

    protected $table = 'articulos';
    protected $connection = 'tenant';

    protected $fillable = [
        'codigo',
        'nombre',
        'nombre_factura',
        'codigo_barras',
        'porcentaje_iva',
        'id_iva',
        'grava_ice',
        'factor_ice',
        'stock_actual',
        'stock_max',
        'stock_min',
        'caduca',
        'venta_fracionada',
        'precio_compra_sin_iva',
        'precio_compra_con_iva',
        'venta_restringida',
        'vehiculo',
        'pais_origen',
        'id_fabricacion',
        'id_categoria',
        'id_tipo',
        'id_marca',
        'id_presentacion',
        'id_deducible_ir',
        'id_ubicacion'
    ];

    public static function boot() {
        parent::boot();
        static::Reconectar();
    }

    public function categorias(){
        return $this->belongsTo('App\Models\Empresas\CategoriaArticulo', 'id_categoria');
    }

    public function tipos(){
        return $this->belongsTo('App\Models\Empresas\TipoArticulo', 'id_tipo');
    }

    public function marcas(){
        return $this->belongsTo('App\Models\Empresas\MarcaArticulo', 'id_marca');
    }

    public function presentacion(){
        return $this->belongsTo('App\Models\Empresas\PresentacionArticulo', 'id_presentacion');
    }

    public function deducible_ir(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\DeducibleIR', 'id_deducible_ir');
    }

    public function ubicacion(){
        return $this->belongsTo('App\Models\Empresas\UbicacionArticulo', 'id_ubicacion');
    }

    public function porcentajes_iva(){
        return $this->setConnection('mysql')->belongsTo('App\Models\Dashboard\PorcentajesIVA','porcentaje_iva');
    }

    public function tipo_iva(){
        return $this->belongsTo('App\Models\Empresas\TipoIva', 'id_iva');
    }
}
