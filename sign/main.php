
<body class="bg">
		<main>
        <body>
        
        <?php
            require 'menu_user.php'; // главное меню

            if( isset($_GET['main'])) 
        
            {
                if (!isset($_GET['pg']))
                    $_GET['pg'] = '1';
                if (!isset($_GET['sort']))
                    $_GET['sort'] = 'byID';
                echo getFriendsList($_GET['sort'], $_GET['pg']); } else
            if( isset($_GET['random']) ) { include 'random.php'; } 
        ?>    
    </body>

<?php
    function getFriendsList($type, $page)
    {
    // осуществляем подключение к базе данных
    $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');

    mysqli_query($mysqli, 'SET NAMES UTF8');
    if (!$mysqli){
        echo "Sorry <br>";
        echo mysqli_connect_error();
        exit();
    }
    
    if (mysqli_connect_errno($mysqli) ) // проверяем корректность подключения
        return 'Ошибка подключения к БД: '.mysqli_connect_errno(); //возвращает код ошибки
            
    // формируем и выполняем SQL-запрос для определения числа записей
    $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM termins');
        
    // проверяем корректность выполнения запроса и определяем его результат
    if (!(mysqli_errno($mysqli)) && ($row=mysqli_fetch_row($sql_res))) {        //mysqli_fetch_row() возвращает массив строк,
        if (!$TOTAL=$row[0]) // если в таблице нет записей                   соответствующих данным в выбранной строке результирующей таблицы
            return 'В таблице нет данных'; // возвращаем сообщение

            $PAGES = ceil($TOTAL/10); // вычисляем общее количество страниц
            if( $page>=$TOTAL ) // если указана страница больше максимальной
                $page=$TOTAL-1; // будем выводить последнюю страницу

            if ($page == 1 || $page <=0 || $page > $PAGES )
                 $sql = mysqli_query($mysqli, "SELECT * FROM termins LIMIT 0, 10");
            else{
                $start = $page * 10-10;
                $sql = mysqli_query($mysqli, "SELECT * FROM termins LIMIT ".$start.", 10");
            }
            
  
  
            $sql_res=mysqli_query($mysqli, 'SELECT COUNT(*) FROM termins');
            $serial = 0;
            $ret='<main1><table class="d-flex flex-column justify-content-center m-3 card card-body bg-transparent border"><tr class="m-1 top_table"><td></td><td>Термин</td><td>Значение</td></tr>'; // строка с будущим контентом страницы
            $res_arr = array();
            while ($row = mysqli_fetch_assoc($sql)) {
                $serial++;
                $ret.='<tr><td class="serial">'.$serial.'</td><td>'.$row['termin'].'</td><td>'.$row['meaning'].'</td></tr>';
                $index=$row['termin'];
                $res_arr = array($index => '<tr><td class="serial">'.$serial.'</td><td>'.$row['termin'].'</td><td>'.$row['meaning'].'</td></tr><br><br>');
            }
            $ret.='</table>'; // заканчиваем формирование таблицы с контентом
            if( $PAGES>1 ) // если страниц больше одной – добавляем пагинацию
            {
                $ret.='<ul class="d-flex align-items-end justify-content-end mr-3 pages">'; // блок пагинации
                for($i=0; $i<=($PAGES-1); $i++) // цикл для всех страниц пагинации
                if (isset($_GET['pg'])){
                   if( $i+1 != $page) // если не текущая страница
                        $ret.='<li><a href="?view&sort='.$_GET['sort'].'&pg='.($i+1).'">'.($i+1).'</a></li>';
                    else // если текущая страница
                        $ret.='<li><span>'.($i+1).'</span></li>';
                }else{
                    $ret.='<li><a href="?view&sort='.$_GET['sort'].'&pg='.($i+1).'">'.($i+1).'</a></li>';
                }
                $ret.='</ul>';
            }
            else                 
                $ret.='</main1>';
            return $ret; // возвращаем сформированный контент
        } else
        // если запрос выполнен некорректно
        return 'Неизвестная ошибка'; // возвращаем сообщение
    }
?>
