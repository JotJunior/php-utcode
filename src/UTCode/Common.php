<?php
/**
 * Created by PhpStorm.
 * User: jot
 * Date: 16/03/2018
 * Time: 18:45
 */

namespace UTCode;

class Common
{

    /**
     * @param mixed $string
     *
     * @return bool
     */
    static public function isJson($string): bool
    {
        if ('string' !== \gettype($string)) {
            return false;
        }
        \json_decode($string);
        return (\json_last_error() === JSON_ERROR_NONE);
    }

    /**
     * @param $object
     *
     * @return array
     */
    static public function objectToArray($object)
    {
        if (\is_object($object)) {
            $object = \get_object_vars($object);
        }
        if (\is_array($object)) {
            return \array_map(__METHOD__, $object);
        } else {
            return $object;
        }
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    static public function isUnicode(string $string): bool
    {
        return (\mb_strlen($string) !== \strlen($string)
            || false !== \strpos($string, ' '));
    }

}