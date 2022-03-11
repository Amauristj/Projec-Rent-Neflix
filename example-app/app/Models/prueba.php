<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prueba extends Model
{
    protected $table = 'user';

    public function accountNeflix()
    {
        return $this->hasMany('App\Models\CuentaNeflix', 'user_id');
    }
}
