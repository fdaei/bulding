<?php

namespace App\Casts;

use App\Enums\TypeNoticeEnum;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class NoticeConditionCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if(is_int($value)) return TypeNoticeEnum::READ[$value];
        return $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        if($value=="در حال انتظار"){
            return 2;
        }
        elseif ($value=="لغو شده"){
            return 0;
        }
        elseif ($value=="تایید شده"){
            return 1;
        }
        else {
            return $value;
        }
    }
}
