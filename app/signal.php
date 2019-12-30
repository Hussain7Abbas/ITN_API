<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class signal extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idSi';

    /* ============== The attributes that are mass assignable. =============
                                * @var array */
    protected $fillable = [
        'idSi', 'action', 'pairs', 'tp', 'sl', 'lot', 'date'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
