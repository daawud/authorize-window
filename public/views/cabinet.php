<?php

use app\Db;
use app\User;
use app\Validator;

session_start();

$dir = realpath(__DIR__ . '/../../');
spl_autoload_register(function ($class_name) use ($dir) {
    $file = $dir . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class_name).'.php';
    if (file_exists($file)) {
        require_once $file;
    }
    //    echo '<pre>'; print_r($file); die;
});

$model = new User(Db::getInstance());

$data = $_POST;

if ($data) {
    if (isset($data['signup'])) {
		$validator = new Validator($_POST);
        $data = $validator->validate(Validator::REGISTRATION);
        if ($data->errors) {
            header('Location: http://localhost/views/register.php');
        }
        $response = $model->signUp($data);

    }
}

$id = $_SESSION['userId'] ?? null;
if (!$id) {
    header('Location: http://localhost');
}
$user = $model->getUserById($id);

?>

<html lang="ru">
<head>
    <title>"Test"</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">Добро пожаловать, <?=$user->name?></h5>
            <a class="btn btn-outline-primary" href="http://localhost">Выйти</a>
        </div>
        <br>
        <form action="" method="post">
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Имя" value="<?=$user->name?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10">
                    <input name="lastname" type="text" class="form-control" placeholder="Фамилия" value="<?=$user->lastname?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Отчество</label>
                <div class="col-sm-10">
                    <input name="middlename" type="text" class="form-control" placeholder="Отчество" value="<?=$user->middlename?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword4" class="col-sm-2 col-form-label">Пароль</label>
                <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Пароль">
                </div>
            </div>
            <button name="signup" type="submit" class="btn btn-primary">Обновить профиль</button>
        </form>
    </div>
</body>
