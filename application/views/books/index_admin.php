<?php /** @var Model_books [] $data */
    /** @var Model_books $item */
?>
<div id="fon"></div>
<div id="load"></div>
<div class="btn-row sort">
    <div id="admin" class="sort">
        <strong class="">Sorting</strong>
        <button id="id" type="button" class="btn btn-warning" data-toggle="button">Is new or old</button>
        <button id="name" type="button" class="btn btn-warning" data-toggle="button">Name</button>
        <button id="email" type="button" class="btn btn-warning" data-toggle="button">E-mail</button>
        <button id="status" type="button" class="btn btn-warning" data-toggle="button">Status</button>
    </div>
</div>
<form enctype="multipart/form-data" method="post" class="form-horizontal">
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button id="admin_conf" type="submit" class="btn btn-lg btn-success navbar-fixed-bottom">Confirm</button>
        </div>
    </div>
    <div id="content">
        <div id="main">
            <div id="task">
                <?php foreach($data as $index => $item) : ?>
                    <hr>
                    <dl class="dl-horizontal">

                        <dt>Task№ <?= $item->id?></dt>
                        <dt>User Name: <?= $item->name ?></dt>
                        <dt>User Email: <?= $item->email ?></dt>
                        <dt>
                        <div class="checkbox">
                            <?php if($item->is_solved): ?>
                                <label><input name="is_solved-<?= $item->id ?>" type="checkbox" checked>Completed</label>
                            <?php else: ?>
                                <label><input name="is_solved-<?= $item->id ?>" type="checkbox"> Completed</label>
                            <?php endif; ?>
                        </div>
                        </dt>
                        <dd>
                            <input for="description" name="id-<?= $item->id ?>" class="col-sm-2 control-label" hidden value="<?= $item->id ?>">
                            <div class="col-sm-5">
                                <div class="input-group-addon">
                        <textarea class="form-control" id="descr" rows="10" required="required"
                                  name="description-<?= $item->id ?>"><?= $item->description ?></textarea>
                                </div>
                            </div>
                        </dd>


                        <?php
                            if(empty($item->image)){
                                $item->image = '/images/noPicture.png';
                            }else{
                                $item->image = '/images/'.$item->image;
                            }
                        ?>
                        <!--<dd><img id="img" src="<?= $item->image ?>" class="img-circle"></dd>-->

                    </dl>

                <?php endforeach; ?>
                <hr>
            </div>
        </div>
    </div>
</form>
