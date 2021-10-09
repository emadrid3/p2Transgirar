<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carga extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'tipoCarga',
    ];
}
