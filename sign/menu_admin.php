<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php 
    if (!isset($_GET['pg']))
        $_GET['pg'] = '1';
?>

<div class="d-flex justify-content-center">
    <a class="btn btn-dark mt-5 m-3" href="?admin">Просмотр</a>
    <a class="btn btn-dark mt-5 m-3" href="?add" <?php if (isset($_GET['add'])) echo 'class="active"'; ?>>Добавление</a>
    <a class="btn btn-dark mt-5 m-3" href="?delete"  <?php if (isset($_GET['delete'])) echo 'class="active"'; ?>>Удаление</a>
    <a class="btn btn-dark mt-5 m-3" href="?edit" <?php if (isset($_GET['edit'])) echo 'class="active"'; ?>>Редактирование</a>
</div>

</header>
