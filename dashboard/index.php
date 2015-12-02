<!DOCTYPE html>
<!-- saved from url=(0041)http://mybootstrap.ru/examples/hero.html# -->
<html lang="ru">
<head>
    <title>.: ПОРТАЛ ОБЩЕЖИТИЯ НИЯУ МИФИ :. </title>
    <!--Мета-данные-->
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Портал общежития НИЯУ МИФИ">
    <meta name="author" content="campus">
    <!--Конец-->

    <!-- Cтили-->
    <link rel="stylesheet" type="text/css" href="../css/dropdown.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="../css/content.css">
    <link rel="stylesheet" type="text/css" href="../css/datepicker3.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/button.css"/>
    <link rel="stylesheet" type="text/css" href="../css/jquery.rating.css"/>
    <link rel="stylesheet" type="text/css" href="../css/jquery.bootgrid.css"/>
    <!--Конец-->
</head>

<body>
<!--Меню-->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <!--Для мобильных устройств-->
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--Для мобильных устройств END-->
            <a class="navbar-brand" href="../index.php">Портал общежития НИЯУ МИФИ</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="../index.php">ГЛАВНАЯ</a>
                </li>
                <li class="active">
                    <a href="/campus/dashboard/index.php">ДОСКА ОБЪЯВЛЕНИЙ</a>
                </li>
                <li>
                    <a href="../services/index.php">УСЛУГИ</a>
                </li>
            </ul>
            <?php
            include("../lib/log.php");
            include("../lib/check_serv.php");
            ?>
            <ul class="nav navbar-nav navbar-right">
                <li id="sign-out1" style="display: none;">
                    <a type=button class="account btn-group-au">
                        <span id="login"></span>
                        <img src="/campus/pictures/arrow_w.png"/>
                    </a>
                </li>
                <li>
                    <div class="submenu" style="display: none; ">
                        <ul class="root" id="sign-out2" style="display: none;">
                            <li>
                                <a href="/campus/profile/index.php">Личный кабинет</a>
                            </li>
                            <li>
                                <input type="button" id="logout_btn" onclick="logout()" value="Выйти"/>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li id="auth_and_reg1" style="display: none;">
                    <a class="btn-group-au" href="/campus/registration/registration.php">РЕГИСТРАЦИЯ</a>
                </li>
                <li id="auth_and_reg2" style="display: none;">
                    <a class="btn-group-au" data-toggle="modal" data-target="#myModal" href="#myModal">АВТОРИЗАЦИЯ</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--Меню END-->
<!-- Контейнер. Центральная часть-->
<div class="container">
    <div class="span3">
        <div class="card" style="margin-bottom: 2%">
            <a class="btn btn-default" href="../dashboard/index.php">Просмотр объявлений</a>
            <a class="btn btn-default" href="../dashboard/edit.php">Новое объявление</a>
            <a class="btn btn-default" href="../dashboard/all.php">Объявления для проверки</a> <!/--для модеров
            и админов -->
        </div>
        <table class="table table-hover">
            <tbody>
            <tr>
                <td>
                    <div class="content">
                        <div class="col-sm-2 col-md-2">
                            <br/>
                            <img id="picture" src="../pictures/no_photo.jpg" class="img-rounded img-responsive"/>
                        </div>
                        <div class="col-sm-4 col-md-4">

                            <br/>

                            <p><strong>Автор: </strong>Долгач</p>

                            <p><strong>Категория: </strong>Покупка</p>

                            <p>Куплю стиральную машину, недорого, 2 корпус</p>
                            </br>
                            <p><strong>Добавлено: </strong> 6.6.666 в 6:06</p>

                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="btn btn-group">
                                <button type="button" class="glyphicon glyphicon-thumbs-up btn btn-default"> Мне
                                    нравится
                                </button>
                                <a type="button" href="../dashboard/my.php"
                                   class="glyphicon glyphicon-comment btn btn-default"> Подробнее
                                </a>
                                <button type="button" class="glyphicon glyphicon-trash btn btn-default"> Не актуально
                                </button>
                            </div>
                        </div>

                    </div>
                </td>

            </tr>

            </tbody>
        </table>


    </div>

</div>
<!-- Контейнер. Центральная часть END-->
<!-- Пол-->
<footer>
    <p style="color:white">© Портал общежития НИЯУ МИФИ, 2015</p>
    <font style="color:white">© 2015 Портал общежития НИЯУ МИФИ
        <br>
        г. Москва, ул. Москворечье, д. 2. корп. 1 и 2
        <br>
        г. Москва, ул. Москворечье, д. 19, корп. 3 и 4
        <br>
        г. Москва, ул. Кошкина, д. 11, корп. 1.
        <br>
        Заведующая общежитием - Мозгунова Валентина Ивановна, тел. (499) 725-24-47, ул. Москворечье, д. 2, кор. 1, ком.
        142
        <br>
        Заместитель директора - Тараканов Юрий Михайлович, тел. (499) 725-24-85, ул. Москворечье, д. 2 кор. 2, ком. 8
        <br>
        Начальник управления студенческими общежитиями — Краскович Сергей Леонидович, тел. (499) 725-24-85
        <br>
    </font>
</footer>
<!-- Пол END-->
<!-- JavaScript. Для быстрой загрзуки помещайте в конце страницы, указав в начале скрипт jQuery-->
<script src="../js/jquery2.4.1.js"></script>
<script src="../js/moment-with-locales.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/moment-with-locales.min.js"></script>
<script src="../js/bootstrap-datetimepicker.min.js"></script>
<script src="../js/bootstrap-tab.js"></script>
<script src="../js/right-bar.js"></script>
</body>
</html>