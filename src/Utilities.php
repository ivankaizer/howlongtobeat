<?php

namespace ivankayzer\HowLongToBeat;

class Utilities
{
    /**
     * @param array $array
     * @return array
     */
    public static function flattenArray(array $array)
    {
        $return = array();

        array_walk_recursive($array, function($x, $key) use (&$return) { $return[$key] = $x; });

        return $return;
    }

    public static function convertAbbreviationsToNumber($input)
    {
        if (strpos($input, '.') === false && strpos($input, 'K') !== false) {
            return str_replace('K', '000', $input);
        }

        return str_replace(['.', 'K'], ['', '00'], $input);
    }
}