<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Points;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

<?php /*

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'image_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_dir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'free' => 'Free', 'busy' => 'Busy', ], ['prompt' => '']) ?>

*/ ?>

    <?php
    $points = Points::find()->all();
    $items = ArrayHelper::map($points,'id','name');
    $params = [ 'prompt' => 'Select Point' ];
    ?>

    <?= $form->field($model, 'points_id')->dropDownList($items, $params) ?>

<?php /*

    <?= $form->field($model, 'use_user_id')->textInput() ?>

    <?= $form->field($model, 'create_user_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

*/ ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
