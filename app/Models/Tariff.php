<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable= [
        'id',
        'notice_type',
        'price',
        'time' ,
        'revival',];
    public function Notices():hasMany
    {
        return $this->hasMany(Notice::class);
    }
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }
}
