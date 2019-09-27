<?php


namespace components;

/**
 * Class Server
 */
final class Server
{
    /**
     * Возвращает запрос
     * @return string|null
     */
    public static function getUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (!empty($uri) && $uri != '/') {
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

    /**
     * Возвращает адрес откуда пришли
     * @return mixed|string
     */
    public static function getReferer()
    {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
    }

    /**
     * Возвращает путь к корню проекта
     * @return mixed
     */
    public static function getRootPath()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }
}
