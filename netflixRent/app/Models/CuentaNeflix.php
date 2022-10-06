<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaNeflix extends Model
{
    protected $table = 'cuenta_netflix';

    public function accountusernetflix()
    {
        return $this->hasMany('App\Models\UserCuentaNeflix', 'cuenta_netflix_id');
    }

}
