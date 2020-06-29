<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SubCategory extends Enum
{
    const Company =   1;
    const Library =   2;

    public static function parse(int $subId): ?string
    {
        switch ($subId) {
            case 1:
                return 'شركة';
            case 2:
                return 'مكتبة';
            default:
                return 'N/A';
        }
    }

}
