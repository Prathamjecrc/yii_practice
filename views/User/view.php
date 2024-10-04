<?php

use app\models\SubEmployee;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sub Employee';

$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?= Html::a('Create Sub Employee', ['sub-create', 'id' => $employee_id], ['class' => 'btn btn-success']) ?>
</p>




    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'id',
        'username',
        'email:email',
        'role',
        'password',
        [
            'class' => ActionColumn::className(),
            'template' => '{update} {delete}', // Only show update and delete buttons
            'urlCreator' => function ($action, SubEmployee $model, $key, $index, $column) {
                if ($action === 'update') {
                    return Url::toRoute(['sub-update', 'id' => $model->id]);
                }
                if ($action === 'delete') {
                    return Url::toRoute(['sub-delete', 'id' => $model->id]);
                }
            }
        ],
    ],
]); ?>


</div>
