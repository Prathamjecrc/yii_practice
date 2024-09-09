<?php

namespace app\controllers;

use Yii;
use app\models\Student;

class DemoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }




public function actionDemo_form()
{
    $model = new Student();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here

       
            $model->save();

            return $this->redirect(Yii::$app->urlManager->createUrl(['site/login']));
        }
    }

    return $this->render('deom_form', [
        'model' => $model,
    ]);
}

}
