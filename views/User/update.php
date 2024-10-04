<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = 'Update Employee: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => 'Sub Employee', 'url' => ['view', 'id' => $model->employee_id]]; // Correct id passed

$this->params['breadcrumbs'][] = ['label' => 'Sub Employee', 'url' => ['view', 'id' =>  $employeeId ]]; 
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
