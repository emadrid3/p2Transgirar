<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'placa',
        'ciudad',
        'tipo',
        'conductor',
        'estado'
    ];

    public function driver() {
        return $this->hasOne(conductor::class, 'id', 'conductor');
    }
}
