<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var ActiveForm $form */
?>
<div class="book-create">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'isbn') ?>
        <?= $form->field($model, 'img') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'year') ?>
        <?= $form->field($modelAuthor, 'name')->label('Author name') ?>

    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- book-create -->
