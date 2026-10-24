<?php

namespace App\Enum;

enum LocationType: string
{
    case COUNTRY = "country";
    case STATE = "state";
    case DISTRICT = "district";
    case CITY = "city";
    case VILLAGE = "village";
    case ROOT = "root";
    case SUB = "sub";
}
