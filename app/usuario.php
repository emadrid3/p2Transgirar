<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user',
        'pass'
    ];
}
