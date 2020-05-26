<?php
require_once 'GetMenu.php';


class GetMenuTest extends PHPUnit_Framework_TestCase
{
    public function testGetMenu()
    {
        $menu = new Menu();
        $this->assertTrue($menu->getMenu());    
    }
}
