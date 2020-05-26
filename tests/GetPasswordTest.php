<?php
require_once 'GetPassword.php';


class GetPasswordTest extends PHPUnit_Framework_TestCase
{
    public function testGetPassword()
    {
        $obj = new User();
        $user['login'] = 'login';
        $this->assertArrayHasKey('password', $obj->getPassword($user));
    }
}
