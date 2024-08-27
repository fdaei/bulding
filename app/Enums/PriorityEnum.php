<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class PriorityEnum extends Enum
{
    const Much =   0;
    const middle =   1;
    const Low = 2;
    const READ = [
        self::Much => 'زیاد',
        self::middle => 'متوسط',
        self::Low => 'کم',
    ];

}
