<?php
session_start();
require 'func.php';

$car = array();
if ((isset($_POST['check'])) && (isset($_POST['mark'])) && (isset($_POST['model']))
    && (isset($_POST['year'])) && (isset($_POST['cost'])) && (isset($_POST['mileage'])))
{
    $car['mark']    = htmlspecialchars($_POST['mark']);
    $car['model']   = htmlspecialchars($_POST['model']);
    $car['year']    = htmlspecialchars($_POST['year']);
    $car['cost']    = htmlspecialchars($_POST['cost']);
    $car['mileage'] = htmlspecialchars($_POST['mileage']);
    add($car, 'car');
    header ('Location: index_car.php');
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
    <link rel="icon" href="Pictures\favicon.png">
    <link href="bootstrap\bootstrap.min.css" rel="stylesheet">
    <link href="css_for_BD.css" rel="stylesheet">
    <link href="bootstrap\form-validation.css" rel="stylesheet">
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
                <a class="nav-link" href="#">Фирмы производители <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Автомобили <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Водители <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">Журнал поступления автомобилей <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index_salons.php">БД салонов<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
            <?php
            if (!isset($_SESSION["email"]))
            {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="signin.php">Войти <span class="sr-only">(current)</span></a>
                </li>
                <?php
            }
            ?>
            <?php
            if (isset($_SESSION["email"]))
            {
                ?>
                <li class="nav-item active">
                    <a class="nav-link" href="user.php"><?php /*echo $_SESSION['email']; */?><span class="sr-only">(current)</span></a>
                </li>
                <?php
            }
            ?>
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
            <div class="col-md-6 order-md-1">
                <h4 class="mb-3">Характеристики автомобиля</h4>
                <form class="needs-validation" novalidate action = "index_car.php" method = "POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="mark">Марка</label>
                            <input type="mark" class="form-control" name="mark"  placeholder="Tesla" value="" required maxlength = "32" pattern="\w*" >
                            <div class="invalid-feedback">
                                Марка машины введена не верно.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="model">Модель</label>
                            <input type="text" class="form-control" name="model" placeholder="Roadster" value="" required maxlength = "32" pattern="\w*">
                            <div class="invalid-feedback">
                                Модель машины введена не верно.
                            </div>
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

                    <input class="btn btn-primary btn-lg btn-block" name="check" value="Добавить автомобиль" type="submit">
                </form>
            </div>
                <div class="col-md-6 order-md-2 mb-6">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text">Добавленные автомобили</span>
                        <span class="badge badge-secondary badge-pill"><?php /*echo $_POST['count'] */?></span>
                    </h4>
                    <ul class="list-group mb-3">
<?php
show('car', 6);
?>
                    </ul>
                </div>
          </div>
    </div>
</main>
<script type="text/javascript" src="validate.js" ></script>
</body>
</html>