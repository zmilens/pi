<?php

class MenuUnsign
{
    public function getMain(){
        $main=file_get_contents('unsign/main.php');
        if($main!=''){
            return true;
        }
        return false;  
    }
}

?>