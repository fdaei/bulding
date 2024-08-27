<?php

namespace App\Models;

use App\Casts\UserConditionCast;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'instagram',
        'website',
        'status',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */

    public function Notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
    public function Orders(): HasMany
    {
        return $this->hasMany(Order::class,'user_id','id');
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function getFullNameAttribute() : string
    {
        return $this->first_name." ".$this->last_name;
    }
}
