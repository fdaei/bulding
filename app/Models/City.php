<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory,SoftDeletes;
    public $timestamps = false;
    protected $fillable=[
      'id','name','state_id'
    ];
    public function State():BelongsTo
    {
        return $this->belongsTo(State::class,'state_id');
    }
    public function Notice(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
    public function firstState()
    {
        return $this->State()->first();
    }

}
