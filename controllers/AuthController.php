<?php


namespace controllers;


use base\BaseController;

class AuthController extends BaseController
{
    public function actionLogin()
    {
        return $this->view('login', ['test' => 'test']);
    }

    public function actionRegister()
    {
        return $this->view('register', []);
    }
}
