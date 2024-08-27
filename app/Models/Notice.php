<?php

namespace App\Models;

use App\Casts\NoticeConditionCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'title', 'context', 'user_id', 'category_id', 'status', 'image', 'address', 'city_id' , 'state_id', 'expire_time', 'expired', 'especial','lat','lng'
    ];
    protected $casts = [
        'status' => NoticeConditionCast::class,
    ];

    public static function truncate()
    {
    }

    public function city():belongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function state():belongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function tariff():belongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    public function commands():HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function commandshow():HasMany
    {
        return $this->hasMany(Comment::class)->where("status",1);
    }
    public function gallerys():HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function notice_features():HasMany
    {
        return $this->hasMany(NoticeFeature::class);
    }

    public function order():HasOne
    {
        return $this->hasOne(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category():belongsTo
    {
        return $this->belongsTo(Category::class);
    }


}
