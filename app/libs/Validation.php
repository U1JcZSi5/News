<?php

namespace libs;

class Validation
{
    private $errors = [];
    private $permitted = false;

    // Add error messages and set $permited
    public function checkInput()
    {
        if (isset($_POST['register_btn'])) {
            foreach ($_POST as $item => $value) {
                if (empty($value)) {
                    $this->errors[] = $item . ' canot be empty';
                }
            }
        }

        if (!$this->errors) {
            $this->permitted = true;
        }

        return $this;
    }

    public static function getPostValues($value)
    {
        if (isset($_POST[$value])) {
            return $_POST[$value];
        }
        return '';
    }

    public function isPermitted()
    {
        return $this->permitted;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
