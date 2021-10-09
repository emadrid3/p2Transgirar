<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class factura extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'invoice';
    protected $fillable = [
        'id',
        'idLogistica',
        'valorFactura',
        'numeroFactura',
        'numeroOrden',
        'valorAdicional',
        'flete',
        'anticipo',
        'porcentaje',
        'idVehiculo',
        'idCliente',
        'estado',
    ];
    public function vehiculo() {
        return $this->hasOne(vehiculo::class, 'id', 'idVehiculo');
    }
    public function cliente() {
        return $this->hasOne(cliente::class, 'id', 'idCliente');
    }
}
