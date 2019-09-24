<?php


namespace base;

/**
 * Class BaseModel
 */
abstract class BaseModel
{
    private $errors;

    abstract function validate();

    public function load($array)
    {
        foreach ($array as $attribute => $value) {
            if (property_exists($this, $attribute)) {
                $this->$attribute = $value;
            }
        }
    }

    public function attributeLabels()
    {
        return [];
    }

    public function getAttributeLabel($attribute)
    {
        $label = $attribute;

        if (isset($this->attributeLabels()[$attribute]) || array_key_exists($attribute, $this->attributeLabels())) {
            $label = $this->attributeLabels()[$attribute];
        }

        return $label;
    }

    public function setError($attribute, $message)
    {
        $this->errors[$attribute] = $message;
    }

    public function getError($attribute)
    {
        return isset($this->errors[$attribute]) ? $this->errors[$attribute] : null;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
