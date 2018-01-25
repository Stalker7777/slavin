<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $user = User::findOne(Yii::$app->user->id); ?>

    <?php if($user->role_id == 1) { $template = '{view} {update} {delete}'; } else { $template = '{view} {update}'; } ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'description:ntext',
            'author',
            //'date',
            // 'image_name',
            // 'image_dir',
            // 'status',
            // 'points_id',
            // 'use_user_id',
            // 'create_user_id',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'template' => $template],
        ],
    ]); ?>
</div>
