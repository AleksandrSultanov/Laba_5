<?php
session_start();
require 'func.php';

$table = table('salon');

if ((isset($_POST['check'])) && (isset($_POST['mark'])) && (isset($_POST['tel'])) && (isset($_POST['email'])))
{
    $salon = salon_array($_POST);
    add($salon, 'salon');
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
                <h4 class="mb-3">Добавить автосалон</h4>
                    <form class="needs-validation" novalidate action="index_salon.php" method = "POST">
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
            <div class="col-md-8 order-md-2 mb-6">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                <?php if(!$table){?>
                    <div class="alert alert-warning" role="alert">
                        Добавленных автосалонов пока нет!
                    </div>
                <?php } else {?>
                    <span class="text">Добавленные автосалоны</span>
                    <span class="badge badge-secondary badge-pill"><?php echo count($table);?></span>
                </h4>
                <?php if (isset($_GET['edit'])){?>
                    <div class="alert alert-success" role="alert">
                        Изменение произошло успешно!
                    </div>
                <?php } ?>
                <ul class="list-group mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">№</th>
                            <th scope="col">Марка</th>
                            <th scope="col">Номер</th>
                            <th scope="col">Email</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $count = 1; foreach ($table as $key => $row) {?>
                        <tr>
                            <th scope="row"><?php echo $count++;?></th>
                            <td><a href="index_car.php?mark=<?php echo $row['mark']?>&id_salon=<?php echo $row['id_salon']?>"><?php echo $row['mark']?></a></td>
                            <td><?php echo $row['number']?></td>
                            <td><?php echo $row['email']?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="edit_salon.php?id_salon=<?php echo $row['id_salon']?>" class="btn btn-warning">Изменить</a>
                                    <a href="delete.php?id_salon=<?php echo $row['id_salon']?>" class="btn btn-danger">Удалить</a>
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
<script type="text/javascript" src="validate.js" ></script>
</body>
</html>


