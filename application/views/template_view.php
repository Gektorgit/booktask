<?php

    $url = explode('/', $_SERVER['REQUEST_URI']);
    if(empty($url[1]) || count($url) < 3){
        $url = 'books/';
    }else{
        $url = '';
    }
    $is_admin = $_SESSION['is_admin'];
    if($is_admin){
        $action = 'admin';
    }else
        $action = 'index';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Главная</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
    <script src="/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/js/form_script.js" type="text/javascript"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-my" role="navigation">
        <div class="container-fluid">
            <!—Название сайта и кнопка раскрытия меню для мобильных-->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $url.$action ?>">Book task</a>
            </div>
            <!—Само меню-->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= $url.$action ?>">List task</a></li>
                    <li><a href="<?= $url ?>newtask">Add new task</a></li>
                </ul>
                <!-- Список ссылок, расположенный справа -->
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <!--<form role="form" method="get" action="index">-->
                            <?php if($is_admin): ?>
                                <a id="signOut" class="btn btn-group-xs btn-info">Sign out</a>
                            <?php else: ?>
                                <a  id="modal" class="btn btn-group-xs btn-success" data-toggle="modal" data-target="#SignModal">Sign in</a>
                            <?php endif; ?>
                       <!-- </form>-->
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <h1>You are welcome</h1>
</header>
<main>
    <div class="alert alert-success hidden" id="success-alert">
        <h2>SUCCESS</h2>
        <div>You are welcome adminy.</div>
    </div>
    <?php include 'application/views/'.$content_view; ?>
</main>
<footer>
    <h6>Produced with Gektor Compan</h6>
</footer>
</body>
</html>

<!-- Модальное окно -->
<div class="modal fade" id="SignModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="myModalLabel">Log in</h4>
            </div>
            <!-- Основная часть модального окна, содержащая форму для регистрации -->
            <div class="modal-body">
                <form role="form" method="post" action="<?= $url?>admin" class="form-horizontal">
                    <div class="form-group has-feedback">
                        <label for="login" class="control-label col-xs-3">Login:</label>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" id="modal_login" name="name" required="required">
                            </div>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="pass" class="control-label col-xs-3">Password:</label>
                        <div class="col-xs-6">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-log-in"></i></span>
                                <input type="password" class="form-control" id="modal_pass" name="pass" required="required">
                            </div>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- Нижняя часть модального окна -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button id="save" type="submit" class="btn btn-primary">Ok</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>