<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $table = 'rols';

    protected $fillable = [
        'id',
        'rol'
    ];
}
