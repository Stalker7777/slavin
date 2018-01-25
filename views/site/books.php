<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 23.01.2018
 * Time: 15:08
 */

use yii\helpers\Html;

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>

<h1>List books</h1>

<div class="container">

    <div class="row">
            <?= Html::beginForm(['site/books', 'point_id' => $point->id], 'post', ['enctype' => 'multipart/form-data']) ?>
        <div class="col-sm-offset-2 col-sm-9">
            <?= Html::input('text', 'find_book', $find_book, ['class' => 'form-control']) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::submitButton('Find', ['class' => 'submit btn btn-primary input-group-append']) ?>
        </div>
            <?= Html::endForm() ?>
    </div>


    <?php foreach ($books as $item) { ?>

        <?php $name_image = "@web/"; ?>
        <?php $name_image .= $item->image_dir . "/" . $item->image_name; ?>

        <div class="row">
            <div class="col-sm-2">
                <?php echo Html::img($name_image, ['width' => '150']) ?>
            </div>
            <div class="col-sm-10">
                <div><h3><?php echo Html::a($item->name, ['site/detail', 'book_id' => $item->id], []); ?></h3></div>
                <?= $item->description; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-offset-8 col-sm-4 text-right">
                <?= $item->author; ?>
            </div>
        </div>

    <?php } ?>

</div>
