<form class="m-5" name="form_add" method="post" action="?add">
    <div class="form-group d-flex flex-column m-4 w-25">
        <label for="exampleFormControlInput1">Логин</label>
        <input class="form-control" type="text" name="login" id="name" placeholder="login" pattern="^[A-Za-zА-Яа-яЁё]+$" required>
        <label for="exampleFormControlInput1">Пароль</label>
        <input class="form-control" type="text" name="password" id="name" placeholder="password">
        <label for="exampleFormControlInput1">Статус</label>
        <select class="form-control" name="status" id="name">
            <option>manager</option>
            <option>user</option>
        </select>
        <input class="btn btn-dark mt-4" type="submit" name="button" value="Добавить запись">
        <br><br><br>
    </div>
</form>
<?php
// если были переданы данные для добавления в БД
if( isset($_POST['button']) && $_POST['button'] == 'Добавить запись')
{
    $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');
mysqli_query($mysqli, 'SET NAMES UTF8');
if( mysqli_connect_errno() ) // проверяем корректность подключения
echo 'Ошибка подключения к БД: '.mysqli_connect_error();
// формируем и выполняем SQL-запрос для добавления записи
$sql_res=mysqli_query($mysqli, 'INSERT INTO logpass (`id`, `login`, `password`, `status`) VALUES (NULL, "'.htmlspecialchars($_POST['login']).'", "'.htmlspecialchars($_POST['password']).'", "'.htmlspecialchars($_POST['status']).'");');

// если при выполнении запроса произошла ошибка – выводим сообщение
if( mysqli_errno($mysqli) ){
echo '<div class="error">Запись не добавлена</div>';
echo mysqli_errno($mysqli);
}
else{ // если все прошло нормально – выводим сообщение
//redirect на эту же страницу, преодолеваем проблему повторной отправки формы POST
header("Location: index.php?add", true, 303);

echo 'Данные успешно отправлены!';
}

}
?>

