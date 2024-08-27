<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryFeatureValue extends Model
{
    use HasFactory,SoftDeletes;
    public $table = "category_feature_values";
    protected $fillable=[
        'id','category_feature_id','feature_value'
    ];
    public function Category_feature():belongsTo
    {
        return $this->belongsTo(CategoryFeature::class);
    }
}
