<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'idUs';

    /* ============== The attributes that are mass assignable. =============
                                * @var array */
    protected $fillable = [
        'idUs', 'name', 'phone', 'gender', 'address', 'XM', 'TNFX', 'joinDay', 'joinDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
