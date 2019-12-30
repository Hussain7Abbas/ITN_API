<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class investor extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idIn';

    /* ============== The attributes that are mass assignable. =============
                                * @var array */
    protected $fillable = [
        'idIn', 'name', 'phone', 'email', 'price', 'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
