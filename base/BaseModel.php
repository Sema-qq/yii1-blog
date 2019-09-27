<?php


namespace base;

/**
 * Class BaseModel
 */
abstract class BaseModel
{
    private $errors;

    abstract function validate();

    abstract public function labels();

    public function load($array)
    {
        foreach ($array as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    public function getLabel($key)
    {
        $label = $key;

        $labels = (array)$this->labels();

        if (isset($labels[$key]) || array_key_exists($key, $labels)) {
            $label = $labels[$key];
        }

        return $label;
    }

    public function hasErrors()
    {
        return (bool)$this->errors;
    }

    public function setError($key, $message)
    {
        $this->errors[$key] = is_array($message) ? implode('. ', $message) : $message;
    }

    public function getError($key)
    {
        return isset($this->errors[$key]) ? $this->errors[$key] : null;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
