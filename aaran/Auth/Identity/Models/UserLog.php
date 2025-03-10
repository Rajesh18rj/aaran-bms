<?php

namespace Aaran\Auth\Identity\Models;

use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    protected $fillable = ['user_id', 'action', 'ip_address'];
}
