<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketResponse extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable= [
        'id',
        'ticket_id',
        'message',
        'to_admin',
        'is_read',
    ];
    public function file()
    {
        return $this->morphOne(TicketFile::class, 'fileable');
    }
    public function ticket():BelongsTo

    {
        return $this->belongsTo(Ticket::class,'ticket_id');
    }
}
