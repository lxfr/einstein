<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Content */
/* @var $form ActiveForm */
?>
<div class="site-search">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'meta_title') ?>
        <?= $form->field($model, 'meta_description') ?>
        <?= $form->field($model, 'content') ?>
        <?= $form->field($model, 'slug') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-search -->
