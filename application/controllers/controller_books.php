<?php

    class Controller_books extends Controller{

        function __construct(){
            parent::__construct();
            $this->model = new Model_books();
            $this->view = new View();
        }

        function action_index(){
            /** @var Model_books[] $data */

            if($_GET['sort_id']){
                $id = strip_tags($_GET['sort_id']);
                $tasks = $this->model->get_data($id);

                foreach($tasks as $index => $item){
                    if(empty($item->image)){
                        $item->image = '/images/noPicture.png';
                    }else{
                        $item->image = '/images/'.$item->image;
                    }
                    if($item->is_solved){
                        $is_solved = '<p id="Yes">Task is solved</p>';
                    }else{
                        $is_solved = '<p id="no">Task is not solved </p >';
                    }
                    // Один из вариантов
                    printf('<hr>
                            <dl class="dl-horizontal">
                                <dt>Task№ %d</dt>
                                <dt>User Name: %s</dt>
                                <dt>User Email: %s</dt>
                                <dd><p id="description">%s</p></dd>
                                <dt>%s</dt> 
                                <dd><img id="img" src="%s" class="img-circle"></dd>
                            </dl>', $item->id, $item->name, $item->email, $item->description, $is_solved, $item->image);
                }
                exit();
            }else{
                $data = $this->model->get_data();
                $this->view->generate('books/index_view.php', $data);
            }
        }

        function action_admin(){
            /** @var Model_books[] $data */

            $data = $this->model->get_data();
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($_POST['name'] == 'admin' && $_POST['pass'] == '123'){
                    $_SESSION['is_admin'] = 1;
                }

                $data = $this->model->update_data($_POST);
            }

            if($_GET['sort_id']){
                $id = strip_tags($_GET['sort_id']);
                $tasks = $this->model->get_data($id);

                foreach($tasks as $index => $item){
                    if($item->is_solved){
                        $is_solved = '<label><input name="is_solved-'. $item->id.'" type="checkbox" checked>Completed</label>';
                    }else{
                        $is_solved = '<label><input name="is_solved-'.$item->id.'" type="checkbox"> Completed</label>';
                    }

                    // Один из вариантов, также возможно передать json
                    printf('<hr>
                            <dl class="dl-horizontal">
                                <dt>Task№ %d</dt>
                                <dt>User Name: %s</dt>
                                <dt>User Email: %s</dt>
                                <dt>
                                    <div class="checkbox">
                                    %s
                                    </div>
                                </dt>
                                <dd>
                                    <input for="description" name="id-' .$item->id. '" class="col-sm-2 control-label" hidden value="' .$item->id.'">
                                    <div class="col-sm-5">
                                        <div class="input-group-addon">
                                            <textarea class="form-control" id="descr" rows="10" required="required"
                                            name="description-' .$item->id. '">%s</textarea>
                                            </div>
                                    </div>
                                </dd>
                            </dl>', $item->id, $item->name, $item->email, $is_solved, $item->description);
                }
                exit();
            }else{
                if($_SESSION['is_admin']){
                    $this->view->generate('books/index_admin.php', $data);
                }else{
                    $this->view->generate('books/index_view.php', $data);
                }
            }
        }

        function action_newtask(){

            $arr = $_POST;
            $path = 'images/';
            $tmp_path = 'tmp/';
            $name = '';
            $arr['image'] = $name;
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Проверяем тип файла
                if(!empty($_FILES['picture']['type'])){
                    $name = $this->model->resize($_FILES['picture']);
                    $arr['image'] = $name;

                    if(!@copy($tmp_path.$name, $path.$name)){
                        $this->view->generate('books/newtask_view.php');
                        echo 'Что-то пошло не так';
                    }else{
                        unlink($tmp_path.$name);
                    }
                }
                $this->model->insert_data($arr);
                $data = $this->model->get_data();
                if($_SESSION['is_admin']){
                    //$this->view->generate('books/index_admin.php', $data);
                    $host = 'http://'.$_SERVER['HTTP_HOST'].'/books/admin';
                }else{
                    //$this->view->generate('books/index_view.php', $data);
                    $host = 'http://'.$_SERVER['HTTP_HOST'].'/books/index';
                }
                header('Location:'.$host);
                //echo 'Загрузка удачна';

            }else{

                $this->view->generate('books/newtask_view.php');
            }
        }
        //Выходим
        function action_signOut(){
            if(isset($_SESSION['is_admin'])){
                unset($_SESSION['is_admin']);
                session_destroy();
            }
        }
    }

?>
