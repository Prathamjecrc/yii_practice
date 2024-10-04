<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserName $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="sub-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Hidden field for employee_id -->
    <?= $form->field($model, 'employee_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

