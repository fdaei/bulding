<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryFeatureCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id','category_feature_id',
    ];
    public $table="category_feature_categories";

}
