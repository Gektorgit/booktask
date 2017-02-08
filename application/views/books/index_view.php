<?php /** @var Model_books [] $data */
    /** @var Model_books $item */
?>
<!-- Затемнение фона на время сортировки -->
<div id="fon"></div>
<div id="load"></div>
<div class="btn-row sort">
    <div id="index" class="sort">
        <strong class="">Sorting</strong>
        <button id="id" type="button" class="btn btn-warning" data-toggle="button">Is new or old</button>
        <button id="name" type="button" class="btn btn-warning" data-toggle="button">Name</button>
        <button id="email" type="button" class="btn btn-warning" data-toggle="button">E-mail</button>
        <button id="status" type="button" class="btn btn-warning" data-toggle="button">Status</button>
    </div>
</div>
<div id="content" class="">
    <div id="main">
        <div id="task">
            <?php foreach($data as $index => $item) : ?>
                <hr>
                <dl class="dl-horizontal">
                    <dt>Task№ <?= $item->id?></dt>
                    <dt>User Name: <?= $item->name ?></dt>
                    <dt>User Email: <?= $item->email ?></dt>
                    <dd><p id="description"><?= $item->description ?></p></dd>
                    <?php
                        if(empty($item->image)){
                            $item->image = '/images/noPicture.png';
                        }else{
                            $item->image = '/images/'.$item->image;
                        }
                    ?>
                    <dt>
                        <?php if($item->is_solved): ?>
                    <p id="Yes">Task is solved</p>
                <?php else: ?>
                    <p id="no">Task is not solved</p>
                <?php endif; ?>
                    </dt>
                    <dd><img id="img" src="<?= $item->image ?>" class="img-circle"></dd>
                </dl>
            <?php endforeach; ?>
            <hr>
        </div>
    </div>
</div>
