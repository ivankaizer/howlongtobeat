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
}