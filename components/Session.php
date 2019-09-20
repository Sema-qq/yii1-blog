<?php


namespace components;

/**
 * Class Session
 */
class Session
{
    /**
     * Запускает сессию
     */
    public static function start()
    {
        session_start();
    }

    /**
     * Возвращает данные из сессии
     * @param $key
     * @return mixed|null
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Кладет данные в сессию
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}
