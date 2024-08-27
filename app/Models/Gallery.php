<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'id','notice_id','path'
    ];
    public function Gallery():belongsTo
    {
        return $this->belongsTo(Gallery::class);
    }
}
