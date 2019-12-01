<?php
session_start();
require 'php/func.php';

if ((isset($_POST["id_car"])))
$rez = delete_car($_POST["id_car"]);

if (isset($_GET['id_salon'])) {
$id_salon = htmlspecialchars($_GET['id_salon']);
$table = table_for_cars($id_salon); }
else header('Location: index_salon.php');

if ((isset($_POST['check'])) && (isset($_POST['model'])) && isset($_GET['mark'])) {
    $mark = htmlspecialchars($_GET['mark']);
    $car = car_array($_POST, $mark);
    $rez = add_car($car, 'car', $id_salon);
    if ($rez === 1)
        header ("Location: index_car.php?mark=$mark&id_salon=$id_salon");
    else
        header('Location: index_salon.php');
}
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
            <li class="nav-item active">
                <a class="nav-link" href="all_cars.php">Автомобили<span class="sr-only">(current)</span></a>
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
            <div class="col-md-4 order-md-1">
                <h4 class="mb-3">Добавить автомобиль</h4>
                <form class="needs-validation" novalidate  method = "POST">

                    <div class="mb-3">
                        <label for="model">Модель</label>
                        <input type="text" class="form-control" name="model" placeholder="Roadster" value="" required maxlength = "32" pattern="\w*">
                        <div class="invalid-feedback">
                            Модель машины введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="year">Год производства</label>
                        <input type="text" class="form-control" name="year" placeholder="2019" required maxlength = "4"  pattern="\d*">
                        <div class="invalid-feedback">
                            Год введен не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="number">Стоимость</label>
                        <input type="text" class="form-control" name="cost" placeholder="10  000 000 ₽" required maxlength = "32" pattern="\d*">
                        <div class="invalid-feedback">
                            Стоимость введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mileage">Пробег</label>
                        <input type="text" class="form-control" name="mileage" placeholder="0 км" required maxlength = "11" pattern="\d*">
                        <div class="invalid-feedback">
                            Пробег введен не верно.
                        </div>
                    </div>

                    <input href="" class="btn btn-primary btn-lg btn-block" name="check" value="Добавить автомобиль" type="submit">
                </form>
            </div>
                <div class="col-md-8 order-md-2 mb-6">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <?php if(!$table){?>
                        <div class="alert alert-warning container" role="alert">
                            Добавленных автомобилей пока нет <br>
                            или такого автосаллона не существует!
                        </div>
                        <?php } else {?>
                        <span class="text">Добавленные автомобили</span>
                        <span class="badge badge-secondary badge-pill"><?php if ($table) echo count($table);?></span>
                    </h4>
                    <?php if (isset($_GET['edit']) or (isset($rez) and ($rez === 1))) { ?>
                        <div class="alert alert-success" role="alert">
                            Действие произошло успешно!
                        </div>
                    <?php } ?>
                    <?php if ((isset($rez)) and ($rez === -1)) { ?>
                        <div class="alert alert-danger" role="alert">
                            Действие произошло с ошибкой!
                        </div>
                    <?php } ?>
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
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $count = 1; if ($table) foreach ($table as $key => $row) {?>
                                <tr>
                                    <th scope="row"><?php echo $count++;?></th>
                                    <td><?php echo $row['mark']?></td>
                                    <td><?php echo $row['model']?></td>
                                    <td><?php echo $row['production_year']?></td>
                                    <td><?php echo $row['cost']?></td>
                                    <td><?php echo $row['mileage']?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="edit_car.php?id_salon=<?php echo $id_salon?>&mark=<?php echo $row['mark']?>&id_car=<?php echo $row['id_car']?>" class="btn btn-warning">Изменить</a>
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
</main>

<form hidden id="car_delete" method="POST">
    <input name="id_car" id="id_car">
</form>

<script type="text/javascript" src="js/validate.js" ></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/delete_car.js"></script>
</body>
</html>