<?php


namespace models;


use base\BaseDbObject;

/**
 * Class Contact
 */
class Contact extends BaseDbObject
{
    const ERROR_SESSION_KEY = 'contact-error';

    public $id;
    public $name;
    public $last_name;
    public $phone;
    public $email;
    public $photo;
    public $user_id;

    public function tableName()
    {
        return 'contacts';
    }

    public function primaryKey()
    {
        return 'id';
    }

    public function validate()
    {
        if (!$this->name) {
            $this->setError('name', 'Не заполнено.');
        } elseif (strlen($this->name) > 30) {
            $this->setError('name', 'Не более 30 символов.');
        }

        if ($this->last_name && strlen($this->last_name) > 30) {
            $this->setError('last_name', 'Не более 30 символов.');
        }

        if (strlen($this->phone) > 100) {
            $this->setError('phone', 'Не более 100 символов.');
        } elseif (preg_match('#[^0-9]#iu', $this->phone)) {
            $this->setError('phone', 'Должен содержать только цифры.');
        }

        if ($this->email) {
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
                $this->setError('email', 'Должен быть типа test@test.ru.');
            } elseif (strlen($this->email) > 150) {
                $this->setError('email', 'Не более 100 символов.');
            }
        }

        return !$this->hasErrors();
    }

    public function labels()
    {
        return [
            'id' => '#',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
            'email' => 'Электронная почта',
            'photo' => 'Фотография'
        ];
    }

    public function photoExists()
    {
        return $this->photo && file_exists(UPLOAD_DIR . $this->photo);
    }

    public function photoSave($filename)
    {
        $this->deleteCurrentPhoto();
        $this->photo = $filename;
        return $this->update(['photo']);
    }

    public function deleteCurrentPhoto()
    {
        if ($this->photoExists()) {
            return unlink(UPLOAD_DIR . $this->photo);
        }

        return true;
    }

    public function getPhoto()
    {
        if ($this->photoExists()) {
            return '/web/uploads/' . $this->photo;
        }

        return '/web/img/image.png';
    }

    public function save()
    {
        if ($this->validate()) {
            $arr = ['name', 'last_name', 'phone', 'email', 'user_id'];
            return $this->id ? $this->update($arr) : $this->insert($arr);
        }

        return false;
    }

    public static function getContact($id)
    {
        if ($contact = self::model()->findByPk($id)) {
            if ($contact->user_id == \components\User::currentUser()->id) {
                return $contact;
            }
        }

        throw new \Exception('Контактн не найден.');
    }

    public function delete()
    {
        if ($this->deleteById($this->id)) {
            $this->deleteCurrentPhoto();
            return true;
        }

        return false;
    }
}
