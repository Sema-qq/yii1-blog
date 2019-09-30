<?php


namespace controllers;


use base\BaseController;
use components\Request;
use components\Server;
use components\Session;
use models\Captcha;
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

    public function actionCaptcha()
    {
        $code = Captcha::genCode();

        Session::set('captcha', $code);

        $font = Captcha::getFont();

        $image = imagecreatetruecolor(150, 40);

        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, 200, 40, $white);

        imagettftext($image, 20, 4, 15, 32, $black, $font, $code);

        header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        header("Content-type: image/gif");
        imagegif($image);
        imagedestroy($image);
    }
}
