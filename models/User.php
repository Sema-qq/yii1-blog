<?php


namespace models;


use base\BaseDbObject;
use components\User as BigUser;

/**
 * Class User
 */
class User extends BaseDbObject
{
    public $id;
    public $login;
    public $password;
    public $repeatPassword;

    public function tableName()
    {
        return 'users';
    }

    public function primaryKey()
    {
        return 'id';
    }

    public function validate()
    {
        if (strlen($this->login) < 2 || strlen($this->login) > 15) {
            $this->setError($this->getLabel('login'), 'От 2 до 15 символов.');
        } elseif (!preg_match('/^[A-Za-z0-9]+$/iu', $this->login)) {
            $this->setError($this->getLabel('login'), 'Только английские буквы или цифры.');
        } elseif (self::model()->find()->where(['login' => $this->login])->one()) {
            $this->setError($this->getLabel('login'), 'Уже занят.');
        }

        if (strlen($this->password) < 8 || strlen($this->password) > 15) {
            $this->setError($this->getLabel('password'), 'От 8 до 15 символов.');
        } elseif (!preg_match('/^[A-Za-z0-9]+$/iu', $this->password)) {
            $this->setError($this->getLabel('password'), 'Только английские буквы или цифры.');
        } elseif (!preg_match('/[A-Za-z]/iu', $this->password)) {
            $this->setError($this->getLabel('password'), 'Должен содержать буквы.');
        } elseif (!preg_match('/[0-9]/iu', $this->password)) {
            $this->setError($this->getLabel('password'), 'Должен содержать цифры.');
        }

        if ($this->password !== $this->repeatPassword) {
            $this->setError($this->getLabel('repeatPassword'), 'Должен совпадать с паролем.');
        }

        return !$this->hasErrors();
    }

    public function labels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'repeatPassword' => 'Повтор пароля'
        ];
    }

    public function login()
    {
        if ($user = self::model()->find()->where(['login' => $this->login, 'password' => $this->getPassword()])->one()) {
            BigUser::login($user);
            return true;
        }

        $this->setError('Ошибка', 'Неправильно введены "Имя пользователя" или "Пароль".');
        return false;
    }

    public function registration()
    {
        if ($this->validate()) {
            $this->password = $this->getPassword();
            if ($this->insert(['login', 'password'])) {
                BigUser::login($this);
                return true;
            }
        }

        return false;
    }

    private function getPassword()
    {
        return sha1($this->password);
    }
}
