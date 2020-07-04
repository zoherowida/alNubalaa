<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class City extends Enum
{
    const Amman = 1;
    const Zarqaa = 2;
    const Irbid = 3;
    const Jerash = 4;
    const Tafila = 5;
    const Balqa = 6;
    const Ajloun = 7;
    const Aqaba = 8;
    const Karak = 9;
    const Madaba = 10;
    const Maan = 11;
    const AlMafraq = 12;

    public static function parse(int $subId): ?string
    {
        switch ($subId) {
            case 1:
                return 'عمان';
            case 2:
                return 'الزرقاء';
            case 3:
                return 'اربد';
            case 4:
                return 'جرش';
            case 5:
                return 'الطفيلة';
            case 6:
                return 'البلقاء';
            case 7:
                return 'عجلون';
            case 8:
                return 'العقبة';
            case 9:
                return 'الكرك';
            case 10:
                return 'مأدبا';
            case 11:
                return 'معان';
            case 12:
                return 'المفرق';
            default:
                return 'N/A';
        }
    }
}

