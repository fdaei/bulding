<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketFile extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable= [
        'id',
        'fileable_id',
        'fileable_type',
        'path',
    ];
    public function fileable()
    {
        return $this->morphTo();
    }
}
