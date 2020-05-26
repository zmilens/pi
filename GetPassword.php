<?php
class User
{
    public function getPassword(array $user)
    {
        if(isset($user['login'])){
        $user['password'] = uniqid($user['login']);
        return $user;
        }
    return false;  
    }
}