<?php


namespace components;

/**
 * Class Server
 */
class Server
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

    /**
     * Возвращает запрос
     * @return string|null
     */
    public static function getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return strtok(trim($_SERVER['REQUEST_URI'], '/'), '?');
        }

        return '/';
    }

    /**
     * Проверяет был ли отправлен запрос постом
     * @return bool
     */
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Проверяет был ли отправлен запрос аяксом
     * @return bool
     */
    public static function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
