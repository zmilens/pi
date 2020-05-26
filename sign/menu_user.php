<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php 
    if (!isset($_GET['pg']))
        $_GET['pg'] = '1';
?>

<div class="d-flex justify-content-center">
    <a class="btn btn-dark mt-5 m-3" href="?main">Просмотр и поиск</a>
    <a class="btn btn-dark mt-5 m-3" href="?random" <?php if (isset($_GET['random'])) echo 'class="active"'; ?>>Рандом</a>
</div>

</header>
