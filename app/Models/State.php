<?php

namespace App\Models;

use App\Casts\NoticeConditionCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable= [
        'name',
    ];
    public function Cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
    public function Notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
}
