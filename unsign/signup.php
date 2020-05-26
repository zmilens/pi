<form class="m-5 d-flex justify-content-center" method="post" action="">
    <h5 class="ml-5">Регистрация</h5>
    <div class="form-group d-flex flex-column m-4 w-25">
        <label for="exampleFormControlInput1">Логин</label>
        <input class="form-control" type="text" name="login_add">
        <label for="exampleFormControlInput1">Пароль</label>
        <input class="form-control" type="password" name="password_add">
        <input type="submit" value="Зарегистрироваться" name="signUp" class="btn btn-dark m-2 mt-4">
    </div>
</form>

<?php 
    if (isset($_POST['signUp'])){
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

        $sql_res=mysqli_query($mysqli, 'INSERT INTO logpass (`id`,`login`, `password`, `status`) VALUES (NULL, "'.htmlspecialchars($_POST['login_add']).'", "'.htmlspecialchars($_POST['password_add']).'", "user");');
        if( mysqli_errno($mysqli) ){
            echo 'Не получилось, повторите позже';
        }else{
            header('Location: index.php?sign', true, 303);
        }
        
    }

?>