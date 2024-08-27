<?php

namespace App\Models;

use App\Casts\InputTypeCasts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryFeature extends Model
{
    use HasFactory,SoftDeletes;
    public $table = 'category_features';
    protected $casts = [
        'type' => InputTypeCasts::class,
    ];

    protected $fillable=[
        'id','category_id','name','type','required_filed','prefix','suffix'
    ];
    public function Categories():belongsToMany
    {
        return $this->belongsToMany(Category::class,'category_feature_categories','category_feature_id','category_id');
    }
    public function Notice_feature():hasMany
    {
        return $this->hasMany(NoticeFeature::class);
    }
    public function category_feature_values():hasMany
    {
        return $this->hasMany(CategoryFeatureValue::class);
    }
}
