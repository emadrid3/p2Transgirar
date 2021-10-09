<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logistica extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'numero_factura',
        'numero_orden',
        'numero_factura_cliente',
        'encargado_id',
        'fecha',
        'vehiculo_id',
        'flete',
        'anticipo',
        'descuento',
        'conductor_id',
        'origen',
        'destino',
        'trayecto',
        'carga_id',
        'tipo_id',
        'cliente_id',
        'extra',
        'extra_total',
        'descripcion',
        'factura_total',
        'estado'
    ];

    public function encargado() {
        return $this->hasOne(User::class, 'id', 'encargado_id');
    }
    public function conductor() {
        return $this->hasOne(conductor::class, 'id', 'conductor_id');
    }
    public function vehiculo() {
        return $this->hasOne(vehiculo::class, 'id', 'vehiculo_id');
    }
    public function cliente() {
        return $this->hasOne(cliente::class, 'id', 'cliente_id');
    }
    public function carga() {
        return $this->hasOne(carga::class, 'id', 'carga_id');
    }
    public function tipo() {
        return $this->hasOne(tipo_vehiculo::class, 'id', 'tipo_id');
    }
    public function origen_obj() {
        return $this->hasOne(ciudad::class, 'id', 'origen');
    }
    public function destino_obj() {
        return $this->hasOne(ciudad::class, 'id', 'destino');
    }
}
