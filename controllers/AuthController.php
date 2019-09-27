<?php


namespace controllers;


use base\BaseController;
use components\Request;
use components\Server;
use models\User;
use components\User as BigUser;

/**
 * Class AuthController
 */
class AuthController extends BaseController
{
    public $layout = 'auth';

    public function actionLogin()
    {
        $user = new User();

        if (Server::isPost()) {
            $user->load(Request::post());

            if ($user->login()) {
                return self::redirect('/contact/index');
            }
        }

        return $this->view('login', [
            'user' => $user
        ]);
    }

    public function actionRegister()
    {
        $user = new User();

        if (Server::isPost()) {
            $user->load(Request::post());

            if ($user->registration()) {
                return self::redirect('/contact/index');
            }
        }

        return $this->view('register', [
            'user' => $user
        ]);
    }

    public function actionLogout()
    {
        BigUser::logout();
        return self::redirect('/auth/login');
    }
}
