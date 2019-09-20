<?php
try {
    /** Автозагрузчик */
    spl_autoload_register(function ($class) {
        $file = str_replace('\\','/', $class);

        if (file_exists($file)) {
            require_once(__DIR__ . $file  . '.php');
        }
    });

    \components\Session::start();
    \components\Router()::start();
} catch (Exception $e) {
    dump($e->getMessage());  //пока так
}












function dump($var)
{
    echo '<pre>';
    var_export($var);
    echo "\n";
}

function dd($var)
{
    echo '<pre>';
    var_export($var);
    die;
}
