<?php


namespace components;

use PDO;

class Connection
{
    /** @var null|PDO  */
    private static $instance = null;

    /**
     * Возвращает подклчючение к базе данных
     * @return PDO|null
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new PDO(
                'mysql:host=mariadb;dbname=book',
                'root',
                '1234',
                [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
            );
        }

        return self::$instance;
    }

    private function __clone () {}
    private function __wakeup () {}
}
