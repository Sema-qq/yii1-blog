<?php
try {
    require_once __DIR__ . '/config/const.php';

    /** Автозагрузчик */
    spl_autoload_register(function ($class) {
        $file = __DIR__ . '/' . str_replace('\\','/', $class) . BASE_EXT;

        if (file_exists($file)) {
            require_once($file);
        }
    });

    \components\Session::start();
    \components\Router::start();
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
