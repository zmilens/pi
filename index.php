<?php
    session_start();

    if ( !isset($_SESSION['user']) && isset($_POST['login']) && isset($_POST['password'])){
        
        $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');
        mysqli_query($mysqli, 'SET NAMES UTF8');

        if (!$mysqli)
        {
            echo "Sorry <br>";
            echo mysqli_connect_error();
            exit();
        }

        if( mysqli_connect_errno() ) // проверяем корректность подключения
            return 'Ошибка подключения к БД: '.mysqli_connect_errno(); 

            $sql_res = mysqli_query($mysqli, 'SELECT * FROM logpass WHERE login="'.$_POST['login'].'"');
            $row=mysqli_fetch_assoc($sql_res);
            if (($_POST['password'])==$row['password']) {
                $_SESSION['user']=$row['status'];
                header('Location: index.php ', true, 303);
            }else
                echo '<h3 class="error">Введены неверные логин или пароль</h3>';

       
        
    }
    else if (!isset($_SESSION['user'])){
        require 'unsign/unsign-menu.php';

        if (isset($_GET['sign'])){
            include 'unsign/sign.php';
        }else if(isset($_GET['signup'])){
            include 'unsign/signup.php';
        }else{
            require 'unsign/main.php';
        }
    }
    else{
        if ($_SESSION['user'] == "user"){ 
            require 'sign/menu.php';
            require 'sign/main.php';
        }else if ($_SESSION['user'] =="manager"){
            require 'sign/menu.php';
            require 'sign/manager.php';
        }else if ($_SESSION['user'] =="admin"){
            require 'sign/menu.php';
            require 'sign/admin.php';
        }
        if (isset($_GET['logout'])){
            session_unset();
            header('Location: index.php?sign', true, 303);
        }
    }

?>

