<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class NoticeFeature extends Model
{
    use HasFactory;
    public $table="notice_features";
    protected $fillable=[
       'id','category_feature_id','value','notice_id'
    ];
    public function Category_features()
    {
        return $this->belongsToMany(CategoryFeature::class,'notice_features','category_feature_id','id');
    }
    public function Notice():belongsTo
    {
        return $this->belongsTo(Notice::class);
    }
}

