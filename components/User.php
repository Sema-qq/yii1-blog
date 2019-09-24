<?php


namespace components;

/**
 * Class User
 */
final class User
{
    public static function isGuest()
    {
        return Session::get('user') ? true : false;
    }

    public static function login($user)
    {
        Session::set('user', $user);
    }

    public static function logout()
    {
        Session::set('user', null);
    }

    public static function getName()
    {
        $user = Session::get('user');
        return 'Батя';
    }
}
