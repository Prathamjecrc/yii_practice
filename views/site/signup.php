<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
             <?php $form = ActiveForm::begin([
                'id' => 'form-signup',
                'options' => ['enctype' => 'multipart/form-data'], 
            ]); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <!-- Dropdown for role -->
                <?= $form->field($model, 'role')->dropDownList([
                    'admin' => 'Admin',
                    'employee' => 'Employee'
                ], ['prompt' => 'Select Role']) ?>

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
                    ]) ?>

                <!-- Dropdown for hobbies -->
                <?= $form->field($model, 'hobbies')->dropDownList([
                    'coding' => 'Coding',
                    'cricket' => 'Cricket',
                    'singing'=> 'Singing',
                    'traveling'=> 'Traveling'
                ],  [
                    'prompt' => 'Select your hobbies',
                    'multiple' => true
                  
                ]) ?>

                <?= $form->field($model, 'profileImage')->fileInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
