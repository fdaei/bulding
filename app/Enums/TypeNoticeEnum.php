<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeNoticeEnum extends Enum
{
    const CANCEL =   0;
    const CONFIRM =   1;
    const PENDING = 2;
    const READ = [
        self::CANCEL => "لغو شده",
        self::CONFIRM => "تایید شده",
        self::PENDING => "در حال انتظار",
    ];
}
