<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class City extends Enum
{
    const Amman =   1;
    const Zarqaa =   2;

    public static function parse(int $subId): ?string
    {
        switch ($subId) {
            case 1:
                return 'عمان';
            case 2:
                return 'الزرقاء';
            default:
                return 'N/A';
        }
    }

}
