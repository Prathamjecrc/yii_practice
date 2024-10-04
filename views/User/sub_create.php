<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\SubEmployee $model */

$this->title = 'Create Sub Employee';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Sub Employee', 'url' => ['view', 'id' => $model->employee_id]]; // Correct id passed
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formsub', [
        'model' => $model,
    ]) ?>

</div>
