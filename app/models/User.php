<?php

namespace models;

class User extends \libs\Database
{
    const TABLENAME = 'users';
    const PRIMARY_KEY = 'user_id';
    const USERNAME = 'username';
    const PASSWORD = 'password';

    // SELECT USERS
    public function getUsers()
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME);
    }

    public function getByUsername($username)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::USERNAME => $username]);
    }

    public function getById($id)
    {
        return $this->select_or_delete('SELECT *', self::TABLENAME, [self::PRIMARY_KEY => $id])->getResults()[0];
    }

    // DELETE USER
    public function deleteUser($conditions)
    {
        $this->select_or_delete('DELETE', self::TABLENAME, $conditions);
    }

    // ADD USER
    public function addUser($data)
    {
        $this->add(self::TABLENAME, $data);
    }

    // UPDATE USER
    public function updateById($id, $data)
    {
        $this->update(self::TABLENAME, self::PRIMARY_KEY, $id, $data);
    }

    // FIX THIS
    public function updateByUsername($username, $data)
    {
        $this->update(self::TABLENAME, self::USERNAME, $username, $data);
    }

    public function getResults()
    {
        return $this->results;
    }
}
