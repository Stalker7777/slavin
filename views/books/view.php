<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?php $user = User::findOne(Yii::$app->user->id); ?>

        <?php if($user->role_id == 1) { ?>

            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>

        <?php } ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'author',
            //'date',
            //'image_name',
            //'image_dir',
            //'status',
            'points_id',
            //'use_user_id',
            //'create_user_id',
            //'created_at',
            //'updated_at',
        ],
    ]) ?>

</div>
