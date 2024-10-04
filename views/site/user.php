<?php
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\grid\ActionColumn;
/** @var yii\web\View $this */
/** @var app\models\StudentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'User List';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?= GridView::widget([
   'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    'columns' => [
    ['class' => 'yii\grid\SerialColumn'], 
        'id',       
        'username', 
        'email',

        'authkey', 

        [
            'class' => ActionColumn::className(),
            'urlCreator' => function ($action, User $model, $key, $index, $column) {
                return Url::toRoute([$action, 'id' => $model->id]);
             }
        ],
    ],
]); ?>
