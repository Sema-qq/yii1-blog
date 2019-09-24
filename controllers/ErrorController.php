<?php


namespace controllers;


use base\BaseController;

/**
 * Class ErrorController
 */
class ErrorController extends BaseController
{
    public function actionError($view, $message = '')
    {
        return $this->view($view, [
            'message' => $message
        ]);
    }
}
