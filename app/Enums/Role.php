<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class Role extends Enum
{
    const Admin =   1;
    const Representative =   2;

    public static function parse(int $subId): ?string
    {
        switch ($subId) {
            case 1:
                return 'مسؤول';
            case 2:
                return 'مندوب';
            default:
                return 'N/A';
        }
    }

}
