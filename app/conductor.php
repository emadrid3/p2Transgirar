<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class conductor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'conductores';

    protected $fillable = [
        'id',
        'nombre',
        'cedula',
        'celular',
        'estado'
    ];
}