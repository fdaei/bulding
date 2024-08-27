<?php

namespace App\Models;

use App\Casts\CommentConditionCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
      'id','title','context','status','user_id','notice_id'
    ];
    protected $casts = [
        'status' => CommentConditionCast::class,
    ];
    public function Notice():belongsTo
    {
        return $this->belongsTo(Notice::class);
    }
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments()
    {
        return $this->morphMany(CommentResponse::class, 'commentable')->where('status',1);
    }

}
