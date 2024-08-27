<?php

namespace App\Models;

use App\Casts\PriorityCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory,SoftDeletes;
    protected $casts = [
        'priority' => PriorityCast::class,
    ];
    protected $fillable= [ 'id', 'user_id', 'title', 'message', 'is_open', 'to_admin', 'is_read', 'priority', ];
    public function file():MorphOne
    {
        return $this->morphOne(TicketFile::class, 'fileable');
    }
    public function responses (): HasMany
    {
        return $this->hasMany(TicketResponse::class , "ticket_id" ,"id");
    }
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
