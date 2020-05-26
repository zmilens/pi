<?php
require_once 'GetMainUnsign.php';


class testGetMain extends PHPUnit_Framework_TestCase
{
    public function testGetMain()
    {
        $main = new MenuUnsign();
        $this->assertTrue($main->getMain());    
    }
}
