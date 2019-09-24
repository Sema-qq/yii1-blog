<?php


namespace components;

/**
 * Class Request
 */
final class Request
{
    /**
     * Возвращает данные из поста или весь массив
     * @param null $key
     * @return mixed|null
     */
    public static function post($key = null)
    {
        if ($key) {
            return isset($_POST[$key]) ? $_POST[$key] : null;
        }

        return $_POST;
    }

    /**
     * Возвращает данные из гет или весь массив
     * @param null $key
     * @return mixed|null
     */
    public static function get($key = null)
    {
        if ($key) {
            return isset($_GET[$key]) ? $_GET[$key] : null;
        }

        return $_GET;
    }
}
