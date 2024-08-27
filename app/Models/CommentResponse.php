<?php

namespace App\Models;

use App\Casts\CommentConditionCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentResponse extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[
        'id','comment_id','user_id','text','status','notice_id'
    ];
    protected $casts = [
        'status' => CommentConditionCast::class,
    ];
    public function user():belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function commentable()
    {
        return $this->morphTo();
    }
    public function comments()
    {
        return $this->morphMany(CommentResponse::class, 'commentable')->where('status',1);
    }
}
