<?php
session_start();
require 'php/func.php';

if ((isset($_POST["id_car"])))
    $rez1 = delete_car($_POST["id_car"]);

$table = table_for_all('car');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тачка.ру: Работа с БД (автомобили)</title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="pictures/favicon.png">
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/css_main.css" rel="stylesheet">
    <link href="bootstrap/form-validation.css" rel="stylesheet">
    <!-- Custom styles for this template -->
</head>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Тачка.ру <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="index_salon.php">Салоны<span class="sr-only">(current)</span></a>
            </li>
            <?php if (!isset($_SESSION["email"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="signin.php">Войти <span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
            <?php if (isset($_SESSION["email"])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="user.php"><?php echo $_SESSION['email']; ?><span class="sr-only">(current)</span></a>
                </li>
            <?php } ?>
        </ul>
        <form class="form-inline mt-md-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Поиск по автомобилям" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
        </form>

    </div>
</nav>
<main role="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <?php if(!$table){?>
                        <div class="alert alert-warning container" role="alert">
                            Добавленных автомобилей пока нет!
                        </div>
                    <?php } else {?>
                    <span class="text">Все добавленные автомобили</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($table);?></span>
                </h4>
                <div class="mb-3">
                    <?php if ((isset($rez1) and ($rez1 === 1)) or ((isset($_GET["edit"] )) and ($_GET["edit"] == "true"))) {  ?>
                        <div class="alert alert-success" role="alert">
                            Действие произошло успешно!
                        </div>
                    <?php } ?>
                    <?php if (((isset($rez1)) and ($rez1 === -1)) or ((isset($_GET["edit"] )) and ($_GET["edit"] == "false"))) { ?>
                        <div class="alert alert-danger" role="alert">
                            Действие произошло с ошибкой!
                        </div>
                    <?php } ?>
                </div>
                <ul class="list-group mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Марка</th>
                            <th scope="col">Модель</th>
                            <th scope="col">Год</th>
                            <th scope="col">Цена</th>
                            <th scope="col">Пробег</th>
                            <th scope="col">Изображение</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; foreach ($table as $key => $row) {?>
                            <tr>
                                <th scope="row"><?php echo $count++;?></th>
                                <td><a href="index_car.php?mark=<?php echo $row['mark']?>&id_salon=<?php echo id_salon($row['mark'])?>"><?php echo $row['mark']?></a></td>
                                <td><?php echo $row['model']?></td>
                                <td><?php echo $row['production_year']?></td>
                                <td><?php echo $row['cost']?></td>
                                <td><?php echo $row['mileage']?></td>
                                <?php if($row['file_path'] != "0") { ?>
                                    <td><img src="<?php echo $row['file_path']?>" class="img-thumbnail" alt="Responsive image"></td>
                                <?php } else echo "<td></td>" ?>
                                <td>
                                    <div class="btn-group">
                                        <a href="edit_car.php?mark=<?php echo $row['mark']?>&id_car=<?php echo $row['id_car']?>" class="btn btn-warning">Изменить</a>
                                        <button type="button" data-id_car="<?php echo $row["id_car"] ?>" class="btn btn-danger" id="delete_btn">Удалить</button>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>

                </ul>
            </div>
            </div>
        </div>
    </div>
</main>

<form hidden id="car_delete" method="POST">
    <input name="id_car" id="id_car">
</form>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/delete_car.js"></script>

</body>
</html>
