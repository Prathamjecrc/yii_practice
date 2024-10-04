<?php 
namespace app\controllers;
use yii\web\Controller;


use Yii;
class Demo2Controller extends Controller {

 public function actionIndex() {

    Yii::$app->session->set("user","pratham");
      
    $name= Yii::$app->session->get("user");
    echo $name;
 }

}