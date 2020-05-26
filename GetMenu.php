<?php
class Menu
{
    public function getMenu(){
        $menu=file_get_contents('sign/menu.php');
        if($menu!=''){
            return true;
        }
        return false;  
    }
}

?>