<?php


namespace models;


use components\Session;

/**
 * Class Captcha
 */
class Captcha
{
    private static $alphabet = ['a','A','b','B','c','C','d','D','e','E','f','F','g','G','h','H','i','I','j',
        'J','k','K','l','L','m','M','n','N','o','O','p','P','q','Q','r','R','s','S','t','T','u','U',
        'v','V','w','W','z','Z','Y','y','x','X','1','2','3','4','5','6','7','8','9','0'];

    public static function genCode()
    {
        $lenghtCode = mt_rand(6, 6);

        $codeChars = '';

        for ($i = 1; $i <= $lenghtCode; $i++) {
            $codeChars .= static::$alphabet[(int)mt_rand(0,count(static::$alphabet))];
        }

        return $codeChars;
    }

    public static function getFont()
    {
        return FONT_DIR . 'Roboto-Bold.ttf';
    }
}
