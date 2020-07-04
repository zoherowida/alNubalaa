<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class AvailableStatus extends Enum
{
    const Available =   1;
    const UnAvailable =   2;

    public static function parse(int $subId): ?string
    {
        switch ($subId) {
            case 1:
                return 'متاح';
            case 2:
                return 'غير متاح';
            default:
                return 'N/A';
        }
    }

}
