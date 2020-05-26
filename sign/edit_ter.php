<?php

    $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');
    
    mysqli_query($mysqli, 'SET NAMES UTF8');
    if( mysqli_connect_errno() ) // если при подключении к серверу произошла ошибка
    {
        // выводим сообщение и принудительно останавливаем РНР-программу
        echo 'Ошибка подключения к БД: '.mysqli_connect_error();
        exit();
    }
    
    // если были переданы данные для изменения записи в таблице
    if( isset($_POST['button']) && $_POST['button']== 'Изменить запись')
    {
        // формируем и выполняем SQL-запрос на изменение записи с указанным id
        $sql_res=mysqli_query($mysqli, 'UPDATE termins SET 
        termin="'.htmlspecialchars($_POST['termin']).'",
        meaning="'.htmlspecialchars($_POST['meaning']).'"
        WHERE id='.$_GET['id']);
        echo 'Данные изменены'; // и выводим сообщение об изменении данных
    }

    $currentROW=array(); // информации о текущей записи пока нет

    // если id текущей записи передано –
    if( isset($_GET['id']) ) // (переход по ссылке или отправка формы)
    {
    // выполняем поиск записи по ее id
        $sql_res=mysqli_query($mysqli, 'SELECT * FROM termins WHERE id = '.$_GET['id'].' LIMIT 0, 1');
        $currentROW=mysqli_fetch_assoc($sql_res); // информация сохраняется
    }
    
    if( !$currentROW ) // если информации о текущей записи нет или она некорректна
    {
        // берем первую запись из таблицы и делаем ее текущей
        $sql_res=mysqli_query($mysqli, 'SELECT * FROM termins LIMIT 0, 1');
        $currentROW=mysqli_fetch_assoc($sql_res);
    }
    // формируем и выполняем запрос для получения требуемых полей всех записей таблицы
    $sql_res=mysqli_query($mysqli, 'SELECT id, termin FROM termins');
    if( !mysqli_errno($mysqli) ) // если запрос успешно выполнен
    {
        echo '<ul id="links_delete_ter">';
        while( $row=mysqli_fetch_assoc($sql_res) ) // перебираем все записи выборки
        {
        // если текущая запись пока не найдена и ее id не передан
        // или передан и совпадает с проверяемой записью
            if( $currentROW['id']==$row['id']) 
            // значит в цикле сейчас текущая запись
                echo '<li>'.$row['termin'].'</li>'; // и выводим ее в списке
            else // если проверяемая в цикле запись не текущая
// формируем ссылку на нее
                echo '<li><a class="bg-dark text-white mt-3 mr-1 ml-5" href="?edit_ter&id='.$row['id'].'">'.$row['termin'].'</a></li>';
        }
        echo '</ul>';
        if( $currentROW ) // если есть текущая запись, т.е. если в таблице есть записи
        {
        // формируем HTML-код формы
            echo '<form name="form_edit" method="post" action="?edit_ter&id='.$currentROW['id'].'">
            <div class="form-group d-flex flex-column m-4 w-25">
                <label for="exampleFormControlInput1">Термин</label>
                <input class="form-control" type="text" name="termin" value="'.$currentROW['termin'].'"  required>
                <label for="exampleFormControlInput1">Значение</label>
                <input class="form-control" type="text" name="meaning" value="'.$currentROW['meaning'].'">
                <input class="btn btn-dark mt-4" type="submit" name="button" value="Изменить запись">
                <br><br><br>
            </div></form>';
        }
        else echo 'Записей пока нет';
        
    }
    else // если запрос не может быть выполнен
        echo 'Ошибка базы данных'; // выводим сообщение об ошибке

?>