<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserSistem extends Authenticatable
{
    protected $table      = 'user_sistem';
    protected $primaryKey = 'id_user';
    protected $fillable   = ['username', 'password', 'level'];
    protected $hidden     = ['password'];
}