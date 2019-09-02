<?php

namespace psnXT;

abstract class Helpers
{
    /**
     * @param int $length
     *
     * @return null|string
     */
    public static function generatePassword($length = 12)
    {
        $length = $length < 12 ? 12 : $length;
        $return      = null;
        $chars       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789()[]{}?!$%&/=*~,.;:<>-_';
        $charsLength = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $randomChar  = $chars[mt_rand(0, $charsLength - 1)];
            $chars       = str_replace($randomChar, '', $chars);
            $charsLength = strlen($chars);
            $return .= $randomChar;
        }
        $containsLowercaseLetter = (bool)preg_match('/[a-z]/', $return);
        $containsUppercaseLetter = (bool)preg_match('/[A-Z]/', $return);
        $containsNumber          = (bool)preg_match('/\d/', $return);
        $containsSpecial         = (bool)preg_match('/[\(\)\[\]\{\}\?\!\$\%\&\/\=\*\~\,\.\;\:\<\>\-\_]/', $return);
        if (!$containsLowercaseLetter || !$containsUppercaseLetter || !$containsNumber || !$containsSpecial) {
            return self::generatePassword($length);
        }

        return $return;
    }

    /**
     * @param $size
     * @param $precision
     *
     * @return string
     */
    public static function byteConvert($size, $precision)
    {
        $base     = log($size, 1024);
        $suffixes = ['', 'KB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    /**
     * @param array $array
     * @return array
     */
    public static function array_filter_deep($array) {
        // If it is an element, then just return it
        if (!is_array($array)) {
            return $array;
        }

        $non_empty_items = [];

        foreach ($array as $key => $value) {
            // Ignore empty cells
            if ($value || is_numeric($value)) {
                // Use recursion to evaluate cells
                $non_empty_items[$key] = self::array_filter_deep($value);
            }
        }

        // Finally return the array without empty items
        return $non_empty_items;
    }
}
