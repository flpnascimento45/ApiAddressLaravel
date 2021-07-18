<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $fillable = [
        'id', 'name', 'login', 'pass', 'address_id',
    ];

    protected $hidden = [
        'pass',
    ];

    protected $table = 'user';

    public $timestamps = false;

    public function returnArray()
    {
        return get_object_vars($this);
    }

}
