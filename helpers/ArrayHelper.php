<?php

namespace gymnast\helpers;

class ArrayHelper
{
    /**
     * Check if all array elements is inside another array
     * @param array $search
     * @param array $all
     * @return boolean
     */
    public static function inArray($search, $all) {
        return count(array_intersect($search, $all)) == count($search);
    }

    /**
     * Fill array element with provided value and path
     * @param array $data Initial array
     * @param array $path Keys array which transforms to path
     * For example, [1, 2, 3] transforms to [1][$childrenNodeName][2][$childrenNodeName][3]
     * or [1][2][3] depending on the $childrenNodeName option value
     * @param mixed $value Saved value
     * @param string|boolean $childrenNodeName For hierarchical arrays
     */
    public static function saveByPath(&$data, $path, $value, $childrenNodeName = 'children')
    {
        $temp = &$data;

        $keysCount = count($path);
        $c = 1;

        foreach($path as $key) {
            if ($c == $keysCount || $childrenNodeName === false) $temp = &$temp[$key];
            else $temp = &$temp[$key][$childrenNodeName];

            $c++;
        }

        $temp = $value;
        unset($temp);
    }
}
