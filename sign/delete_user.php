<?php
        $text = '';
        $mysqli = mysqli_connect('std-mysql', 'std_712', '', 'std_712');

        mysqli_query($mysqli, 'SET NAMES UTF8');
        if (!$mysqli)
        {
            echo "Sorry <br>";
            echo mysqli_connect_error();
            exit();
        }

        if( mysqli_connect_errno() ){ // проверяем корректность подключения
            echo 'Ошибка подключения к БД: '.mysqli_connect_errno();
            exit();
        }
        
            // формируем и выполняем SQL-запрос для определения числа записей
        $sql_res=mysqli_query($mysqli, 'SELECT id, `login` FROM logpass');

        $text .= '<ul class = "m-2">'; 
        $do="";
        $do.='<div <label class="ml-5 mb-3"> Нажмите на ссылку, чтобы удалить</label></div>';
        while( $row=mysqli_fetch_assoc($sql_res) ){
            $text .= '<li><a class="bg-dark text-black m-3" href = "?delete&id='.$row['id'].'&login='.$row['login'].'" class="link_delete">'.$row['login'].'</a></li><br>';
        }
        $text .= '</ul>';
        
        echo $text;

        if (isset($_GET['id'])){
            $delete = mysqli_query($mysqli, 'DELETE FROM logpass WHERE id = '.$_GET['id']);
            echo 'Строка с логином '.$_GET['login'].' удалена';
            ?>
        <script>
            if (!localStorage.getItem("reload")) {
                localStorage.setItem("reload", "true");
                location.reload();
            }

            else {
                localStorage.removeItem("reload");
            }
        </script>
        
        <?php
        } else{ 
            echo $do;
        }
?>