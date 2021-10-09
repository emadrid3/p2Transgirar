<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ciudad extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = 'cities';

    protected $fillable = [
        'id',
        'nombre',
    ];

}