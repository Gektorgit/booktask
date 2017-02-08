<?php
?>
<form id="form" enctype="multipart/form-data" method="post" class="form-horizontal">
    <div class="form-group has-feedback">
        <label for="name" class="col-sm-2 control-label">Name:</label>
        <div class="col-sm-10">
            <div class="input-group-addon">
                <input type="text" class="form-control" id="name" placeholder="Name" required="required" name="name">
            </div>
            <span class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="mail" class="col-sm-2 control-label">E-mail:</label>
        <div class="col-sm-10">
            <div class="input-group-addon">
                <input type="email" class="form-control" id="mail" placeholder="E-mail" required="required" name="email">
            </div>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label for="descr" class="col-sm-2 control-label">Description:</label>
        <div class="col-sm-10">
            <div class="input-group-addon   ">
                <textarea class="form-control" id="descr" rows="10" required="required" name="descr"></textarea>
            </div>
            <span class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="img" class="col-sm-2 control-label">Image: Download only JPG/GIF/PNG </label>
        <div class="col-sm-10">
            <div class="input-group">
                <input type="file" accept="image/jpeg,image/png,image/gif" class="form-control" id="img" name="picture" >
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="confirm" type="submit" class="btn btn-lg btn-success">Confirm</button>
            <button type="button" id="modal" class="btn btn-lg btn-success" data-toggle="modal" data-target="#viewModal">Look task</button>
        </div>
    </div>
</form>


<!-- Модальное окно -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Заголовок модального окна -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="myModalLabel">View</h4>
            </div>
            <!-- Основная часть модального окна, содержащая форму для регистрации -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name:</label>
                    <div class="col-sm-10">
                        <div class="input-group-lg">
                            <input type="text" class="form-control" id="modal_name" name="name" readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mail" class="col-sm-2 control-label">E-mail:</label>
                    <div class="col-sm-10">
                        <div class="input-group-lg">
                            <input type="email" class="form-control" id="modal_mail" name="email" readonly="readonly">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="descr" class="col-sm-2 control-label">Description:</label>
                    <div class="col-sm-10">
                        <div class="input-group-addon">
                            <textarea class="form-control" id="modal_descr" rows="10" name="descr" readonly="readonly"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="img" class="col-sm-2 control-label">Image: </label>
                    <div class="col-sm-10">
                        <div class="input-group-lg">
                            <img id="modal_img" src="home/gektorgit/Загрузки/Baner.jpg" class="img-circle">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Нижняя часть модального окна -->
            <div class="modal-footer">
                    <button class="close" data-dismiss="modal" type="button" class="btn btn-primary">Ok</button>
            </div>
        </div>
    </div>
</div>







