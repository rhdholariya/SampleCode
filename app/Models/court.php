<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class court extends Model
{
    protected $fillable = [
        'court_name',
        'address',
        'city',
    ];

    protected $hidden = [

    ];

}
