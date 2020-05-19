<?php


class LoginModel extends Model
{
    public function checkAdmin($data) {
        if ($data['username'] == 'admin' && $data['password'] == "123") {
            $_SESSION['user'] = $data['username'];
            return true;
        } else
            return false;
    }

}