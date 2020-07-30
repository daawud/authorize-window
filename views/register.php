<?php


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
        <br>
        <form action="" method="post">
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Имя</label>
                <div class="col-sm-10">
                    <input name="name" type="text" class="form-control" placeholder="Имя">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Фамилия</label>
                <div class="col-sm-10">
                    <input name="lastname" type="text" class="form-control" placeholder="Фамилия">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail4" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input name="email" type="email" class="form-control" id="inputEmail4" placeholder="Email">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword4" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input name="password" type="password" class="form-control" id="inputPassword4" placeholder="Пароль">
                </div>
            </div>
            <button name="signup" type="submit" class="btn btn-primary">Зарегистрироваться</button>
            <a href="https://google.com" type="button" class="btn btn-info">Отмена</a>
        </form>
    </div>
</body>
