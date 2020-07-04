<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class StatusApi extends Enum
{
    const Selected = 1;
    const Created = 2;
    const Updated = 3;
    const Deleted = 4;
    const ChangeStatus = 5;
    const Exception = 6;
    const ErrorInRequest = 7;
    const NoAssess = 8;
    const SuccessLogin = 9;


}
