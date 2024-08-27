<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'id','user_id','notice_id','price','is_paid' , 'tariff_id'];

    protected $with = ['user'];

    public function Notice(): BelongsTo
    {
        return $this->belongsTo(Notice::class);
    }

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function tariff(): BelongsTo
    {

        return $this->belongsTo(Tariff::class , "tariff_id" , "id" );
    }
}
