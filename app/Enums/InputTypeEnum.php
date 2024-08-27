<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class InputTypeEnum extends Enum
{
    const text =   0;
    const select =   1;
    const radio = 2;
    const checkbox = 3;
    const READ = [
        self::text => 'text',
        self::select => 'select',
        self::radio => 'radio',
        self::checkbox => 'checkbox',
    ];

}
