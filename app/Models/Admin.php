<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory,SoftDeletes;
    protected $guard = 'operator';
    protected $fillable = [
        'first_name',
        'id',
        'last_name',
        'username',
        'phone_number',
        'email',
        'password',
    ];
}
