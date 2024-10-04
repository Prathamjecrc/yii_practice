<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\UserName $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>



    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>


                <!-- Radio buttons for state -->
                <?= $form->field($model, 'state')->radioList([
                    'rajasthan' => 'Rajasthan',
                    'gujarat' => 'Gujarat',
                    'delhi' => 'Delhi',
                    'maharashtra' => 'Maharashtra'
                    ]) ?>

                <?= $form->field($model, 'city')->checkboxList([
                        'Chittorgarh' => 'Chittorgarh',
                        'Ahmedabad' => 'Ahmedabad',
                        'Nashik' => 'Nashik',
                        'Delhi' => 'Delhi',
                ], ['multiple' => true, 'value' => $model->city]) ?>

                <!-- Dropdown for hobbies -->
                <?= $form->field($model, 'hobbies')->dropDownList([
                    'coding' => 'Coding',
                    'cricket' => 'Cricket',
                    'singing'=> 'Singing',
                    'traveling'=> 'Traveling'
                ],  [
                    'prompt' => 'Select your hobbies',
                    'multiple' => true,'value' => $model->hobbies
                  
                ],) ?>

<?php if ($model->profile_image): ?>
    <p>Current Image: <img src="<?= Yii::getAlias('@web') . '/' . $model->profile_image ?>" width="100" /></p>
<?php endif; ?>

<?= $form->field($model, 'profile_image')->fileInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
