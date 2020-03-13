<?php

namespace libs;

class Session
{
    private const TOKEN = 'token';

    public function sessionExists($name)
    {
        if (isset($_SESSION[$name])) {
            return true;
        }
        return false;
    }

    public function setSession($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public function getSession($name)
    {
        return $_SESSION[$name];
    }

    public function deleteSession($name)
    {
        if ($this->sessionExists($name)) {
            unset($_SESSION[$name]);
        }
    }

    public function setToken()
    {
        return $this->setSession(self::TOKEN, md5(uniqid(rand(), true)));
    }

    public function isTokenValid()
    {
        if (
            $this->sessionExists(self::TOKEN)
            && $this->getSession(self::TOKEN) == \libs\Validation::getPostValues(self::TOKEN)
        ) {
            $this->deleteSession(self::TOKEN);
            return true;
        }
        return false;
    }
}
