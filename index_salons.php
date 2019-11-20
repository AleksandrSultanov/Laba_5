<?php
session_start();
require 'func.php';

$salons = array();
if ((isset($_POST['check'])) && (isset($_POST['mark'])) && (isset($_POST['tel'])) && (isset($_POST['email'])))
{
    $salons['mark'] = htmlspecialchars($_POST['mark']);
    $salons['number'] = htmlspecialchars($_POST['tel']);
    $salons['email'] = htmlspecialchars($_POST['email']);
    add($salons, 'salons');
    header ('Location: index_salons.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Тачка.ру: Работа с БД (салоны)</title>

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
                <a class="nav-link" href="#">Журнал поступления автомобилей<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index_car.php">БД автомобилей<span class="sr-only">(current)</span></a>
            </li>
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
                    <a class="nav-link" href="user.php"><?php echo $_SESSION['email']; ?><span class="sr-only">(current)</span></a>
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
                <h4 class="mb-3">Информация о салоне</h4>
                    <form class="needs-validation" novalidate action="index_salons.php" method = "POST">
                        <div class="mb-3">
                            <label for="mark">Марка</label>
                            <input type="mark" class="form-control" name="mark"  placeholder="Tesla" value="" required maxlength = "32" pattern="\w*" >
                            <div class="invalid-feedback">
                                Марка автосалона введена не верно.
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="tel">Номер телефона</label>
                            <input type="tel" class="form-control" name="tel" placeholder="+78005553535" pattern="^\+7\d{3}\d{7}$" value="" required maxlength = "12">
                            <div class="invalid-feedback">
                                Номер телефона введен не верно.
                            </div>
                        </div>

                    <div class="mb-3">
                        <label for="email">Электронная почта</label>
                        <input type="email" class="form-control" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="email@gmail.com" required >
                        <div class="invalid-feedback">
                            Электронная почта введена не верно.
                        </div>
                    </div>

                    <input class="btn btn-primary btn-lg btn-block" name="check" value="Добавить автосалон" type="submit">
                </form>
            </div>
            <div class="col-md-6 order-md-2 mb-6">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text">Добавленные автосалоны</span>
                    <span class="badge badge-secondary badge-pill"><?php /*echo $_POST['count'] */?></span>
                </h4>
                <ul class="list-group mb-3">
<?php
show("salons", 4);
?>
                </ul>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript" src="validate.js" ></script>
</body>
</html>



