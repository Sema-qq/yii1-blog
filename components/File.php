<?php


namespace components;

/**
 * Class File
 */
class File
{
    /**
     * Возвращает данные из массива или весь массив
     * @param null $key
     * @return mixed|null
     */
    public static function files($key = null)
    {
        if ($key) {
            return isset($_FILES[$key]) ? $_FILES[$key] : null;
        }

        return $_FILES;
    }
}
