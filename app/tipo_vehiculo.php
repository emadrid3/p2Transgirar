<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tipo_vehiculo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipo',
        'idVehiculo',
        'idConductor',
    ];
}
