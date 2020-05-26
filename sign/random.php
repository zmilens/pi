<form class="m-5" method="post" action="">
    <input class="btn btn-dark m-2 mt-4" type="submit" name="button" value="Кликни">
</form>

<?php
    $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');
    mysqli_query($mysqli, 'SET NAMES UTF8');
    
    $sql_res = mysqli_query($mysqli, 'SELECT * FROM termins ORDER BY RAND() LIMIT 1');
    $currentROW=mysqli_fetch_assoc($sql_res);
    $termin="";
    $meaning="";
    $termin=$currentROW['termin'];
    $meaning=$currentROW['meaning'];
    if(isset($_POST['button']) && $_POST['button'] == 'Кликни'){
        if ($currentROW == ''){
            echo "БД пустая";
        }
        else{
            echo '<h5 class="m-5">Термин '.$termin;'</h5>';
            echo '<form method="post" action="">
                <input class="btn btn-dark m-1 mt-4" type="submit" name="button2" value="Посмотреть значение">
                </form>';
        }
    }
    if(isset($_POST['button2']) && $_POST['button2'] == 'Посмотреть значение'){
        if ($currentROW == ''){
            echo "БД пустая";
        }
        else{
            $meaning=$currentROW['meaning'];
            echo '<h5 class="m-5">Термин '.$termin;'</h5>';
            echo '<h5 class="m-5">Значение '.$meaning;'</h5>';
        }
    }
?>