<?php

namespace IvanKayzer\HowLongToBeat;

class Utilities
{
    /**
     * @param array $array
     * @return array
     */
    public function flattenArray(array $array)
    {
        $return = array();

        array_walk_recursive($array, function ($x, $key) use (&$return) {
            $return[$key] = $x;
        });

        return $return;
    }

    /**
     * @param string $input
     * @return string
     */
    public function convertAbbreviationsToNumber($input)
    {
        if (strpos($input, '.') === false && strpos($input, 'K') !== false) {
            return str_replace('K', '000', $input);
        }

        return str_replace(['.', 'K'], ['', '00'], $input);
    }

    /**
     * @param string $time
     * @return null|string
     */
    public function formatTime($time)
    {
        $time = str_replace('½', '.5', $time);

        return $time === '--' ? null : $time;
    }
}
