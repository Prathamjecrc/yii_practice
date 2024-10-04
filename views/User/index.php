<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employee';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php 

   $user = Yii::$app->user->identity;
        if ($user->role=='admin'){
    ?>
    <p>
        <?= Html::a('Create employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    }
    ?>
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
                'attribute' => 'profile_image',
                'label'=> 'Images',
                'format' => 'html',  
                'value' => function ($model) {
                    if (!empty($model->profile_image) && file_exists(Yii::getAlias('@webroot') . '/' . $model->profile_image)) {
                        return Html::img(Yii::getAlias('@web') . '/' . $model->profile_image, [
                            'alt' => 'Profile Image',
                            'class' => 'img-thumbnail',  
                            'width' => '100px',  
                        ]);
                    } else {
                        return 'No image'; 
                    }
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
              'contentOptions' => ['style' => 'width: 290px;'], 
            ],
        ],
    ]); ?>


</div>
