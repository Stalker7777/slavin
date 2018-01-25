<?php
/**
 * Created by PhpStorm.
 * User: STALKER
 * Date: 23.01.2018
 * Time: 15:08
 */

use yii\helpers\Html;

$this->title = 'Points';
$this->params['breadcrumbs'][] = $this->title;

$count_all = count($model);
$count_page = ceil($count_all / 10);

$start = ($current_page - 1) * 10;
$end = $start + 10;

if($end > $count_all) $end = $count_all;

?>

<h1>List points</h1>

<div class="container">

    <?php for ($i = $start; $i < $end; $i += 2) { ?>

    <div class="row">
        <div class="col-sm-6">
            <h3><?php echo Html::a($model[$i]['name'], ['site/books', 'point_id' => $model[$i]['id']], []); ?></h3>
            <h4><?= $model[$i]['address']; ?></h4>
        </div>
        <div class="col-sm-6">
            <?php if($i+1 < count($model)) { ?>
                <h3><?php echo Html::a($model[$i+1]['name'], ['site/books', 'point_id' => $model[$i+1]['id']], []); ?></h3>
                <h4><?= $model[$i+1]['address']; ?></h4>
            <?php } ?>
        </div>
    </div>

    <?php } ?>


    <nav aria-label="Page navigation">
        <ul class="pagination pagination-lg">
            <?php for($i = 1; $i <= $count_page; $i++) { ?>

                <?php if($i == $current_page) { ?>

                    <li class="page-item active">
                        <span class="page-link"><?= $i; ?><span class="sr-only">(current)</span></span>
                    </li>

                <?php } else { ?>

                    <li class="page-item"><?php echo Html::a($i, ['site/points', 'current_page' => $i], ['class' => 'page-link']); ?></li>

                <?php } ?>

            <?php } ?>
        </ul>
    </nav>


</div>
