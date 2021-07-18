<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id', 'city_id', 'address', 'zip_code',
    ];

    protected $table = 'address';
}
