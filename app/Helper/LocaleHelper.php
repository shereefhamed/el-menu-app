<?php
namespace App\Helper;

class LocaleHelper
{
    public static function url($locale)
    {
        $segments = request()->segments();
        $segments[0] = $locale;

        return url(implode('/', $segments));
    }

    
}