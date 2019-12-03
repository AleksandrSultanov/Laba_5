<?php
session_start();
require 'php/func.php';

if (isset($_GET['id_car']) and isset($_GET['mark']))
{
    $id_car = htmlspecialchars($_GET['id_car']);
    $rez = edit_check($id_car, "car");
    $mark = htmlspecialchars($_GET['mark']);
    $row = row("car", $id_car);
}

if ((isset($_POST['check'])) && (isset($_POST['model'])) && (isset($_POST['year'])) &&
    (isset($_POST['cost'])) && (isset($_POST['mileage'])))
    save_car($_POST, $_GET, $_FILES["user_file"], $mark, $id_car);
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
            <div class="col-md-4 offset-md-4">
                <?php if(!empty($err_msg)) {?>
                    <div class="alert alert-danger" role="alert">
                        Произошла ошибка при загрузке файла!<br>
                        Попробуйте снова.
                    </div>
                <?php } ?>
                <?php if($rez == -1) {?>
                    <div class="alert alert-danger" role="alert">
                            Такого автомобиля не существует!<br>
                            Ваще редактирование ни к чему не приведет.<br>
                            Возможно, кто-то удалил этот автомобиль.<br>
                            Рекомендую вернуться на список всех автомобилей.
                    </div>
                 <?php } ?>
                <h4 class="mb-3">Характеристики автомобиля</h4>
                <form class="needs-validation" enctype="multipart/form-data" novalidate method = "POST">

                    <div class="mb-3">
                        <label for="model">Модель</label>
                        <input type="text" class="form-control" value="<?php echo $row["model"]?>" name="model" placeholder="Roadster" required maxlength = "32" pattern="\w*">
                        <div class="invalid-feedback">
                            Модель машины введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="year">Год производства</label>
                        <input type="text" class="form-control" value="<?php echo $row["production_year"]?>" name="year" placeholder="2019" required maxlength = "4"  pattern="\d*">
                        <div class="invalid-feedback">
                            Год введен не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="number">Стоимость</label>
                        <input type="text" class="form-control" value="<?php echo $row["cost"]?>" name="cost" placeholder="10  000 000 ₽" required maxlength = "32" pattern="\d*">
                        <div class="invalid-feedback">
                            Стоимость введена не верно.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mileage">Пробег</label>
                        <input type="text" class="form-control" value="<?php echo $row["mileage"]?>" name="mileage" placeholder="0 км" required maxlength = "11" pattern="\d*">
                        <div class="invalid-feedback">
                            Пробег введен не верно.
                        </div>
                    </div>

                    <div class="mb-3 custom-file">
                        <input type="file" name="user_file"  class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Выберите файл</label>
                        <div class="invalid-feedback">
                            Добавьте изображение.
                        </div>
                    </div>

                    <?php if($row['file_path'] != "0") { ?>
                        <div class=" mb-3" >
                            <label for="image">Текущее изображение</label><br>
                            <input type="image" src="<?php echo $row['file_path']?>" class="img-thumbnail"  width="100"  alt="Responsive image">
                            <br><br>
                        </div>
                    <?php } ?>

                    <input class="btn btn-primary btn-lg btn-block" name="check" value="Сохранить автомобиль" type="submit">
                </form>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript" src="js/validate.js" ></script>

</body>
</html>



