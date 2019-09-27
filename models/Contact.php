<?php


namespace models;


use base\BaseDbObject;

/**
 * Class Contact
 */
class Contact extends BaseDbObject
{
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
        // TODO: Implement validate() method.
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

    public static function getContact($id)
    {
        if ($contact = self::model()->findByPk($id)) {
            if ($contact->user_id == \components\User::currentUser()->id) {
                return $contact;
            }
        }

        throw new \Exception('Контактн не найден.');
    }
}
