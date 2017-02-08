<?php

    class Route{
        static function start(){

            // подгружаем настройки к базе данных
            try{
                $db = new PDO('mysql:host=localhost;dbname=booktask_db; charset=utf8', 'root', 'grsol!16');
                $registry = Registry::get_set_Registry();
                $registry->offsetSet('db', $db);

                session_start();
                if (!isset($_SESSION['is_admin'])) {
                    $_SESSION['is_admin'] = 0;
                }
                //$registry->offsetSet('is_admin', 0);
            }catch(PDOException $e){
                echo $e->getMessage();
            }



            // контроллер и действие по умолчанию
            $controller_name = 'books';
            $action_name = 'index';

            $routes = explode('/', $_SERVER['REQUEST_URI']);
            if($point=strpos($routes[2], "?")){
                $routes[2]=substr($routes[2], 0, $point);
            }
            // получаем имя контроллера
            // Активировать если будет больше двух контроллеров
            /*if(!empty($routes[1])){
                $controller_name = $routes[1];
            }*/

            // получаем имя экшена
            if(!empty($routes[2])){
                $action_name = $routes[2];
            }

            // добавляем префиксы
            $model_name = 'Model_'.strtolower($controller_name);
            $controller_name = 'Controller_'.strtolower($controller_name);
            $action_name = 'action_'.$action_name;

            // подцепляем файл с классом модели (файла модели может и не быть)
            $model_file = strtolower($model_name).'.php';
            $model_path = 'application/models/'.$model_file;
            if(file_exists($model_path)){
                include $model_path;
            }

            // подцепляем файл с классом контроллера
            $controller_file = strtolower($controller_name).'.php';
            $controller_path = 'application/controllers/'.$controller_file;
            /*if(file_exists($controller_path)){
                include $controller_path;
                $controller = new $controller_name;
                $action = $action_name;
            }else{
                /*
                правильно было бы кинуть здесь исключение,
                но для упрощения сразу сделаем редирект на страницу 404
                */
            /*Route::ErrorPage404();
         }*/
            try{
                include $controller_path;
                // создаем контроллер
                $controller = new $controller_name;
                $action = $action_name;
                // вызываем действие контроллера
                $controller->$action();
            }catch(Exception $e){
                echo 'Выброшено исключение: ', $e->getMessage(), "\n";
            }
            /*if(method_exists($controller, $action)){
                // вызываем действие контроллера
                $controller->$action();
            }else{
                // здесь также разумнее было бы кинуть исключение
                Route::ErrorPage404();
            }*/
        }

        /*function ErrorPage404(){
            $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
            header('HTTP/1.1 404 Not Found');
            header("Status: 404 Not Found");
            header('Location:'.$host.'404');
        }*/
    }