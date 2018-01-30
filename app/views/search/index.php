<?= Html::activeLabel($model, 'username', ['label' => 'name']) ?>
<?= Html::activeTextInput($model, 'username') ?>
<div class="hint-block">Please enter your name</div>
<?= Html::error($model, 'username') ?>