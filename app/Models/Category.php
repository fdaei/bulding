<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{

    use HasFactory,SoftDeletes,NodeTrait;
    protected $fillable=[
        'id','name','parent_id','Weight','icon','color','background','image',
    ];
    public function Notice():hasMany
    {
        return $this->hasMany(Notice::class);
    }
    public function categoryFeatures():BelongsToMany
    {
        return $this->belongsToMany(CategoryFeature::class,'category_feature_categories','category_id','category_feature_id');
    }
    public function getFullTitleAttribute($parent_id = null): string
    {
        $item = $this;
        if (!empty($parent_id)) {
            $item = self::findOrFail($parent_id);
        }
        $str = "";
        if (!$item->parent_id) {
            return $item->name;
        }
        $str .= $item->getFullTitleAttribute($item->parent_id) . " &#8592; " . $item->name;
        return $str;
    }

}
