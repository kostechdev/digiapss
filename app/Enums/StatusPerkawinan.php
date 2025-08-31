<?php

namespace App\Enums;

enum StatusPerkawinan: string
{
    case BELUM_MENIKAH = 'Belum Menikah';
    case MENIKAH = 'Menikah';
    case CERAI_HIDUP = 'Cerai Hidup';
    case CERAI_MATI = 'Cerai Mati';
}
