<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class TestController extends Controller{
    public function actionAbout(){
        $this->layout = "index";
        return $this->render("about");
    }

    public function actionHome(){
        $this->layout = "index";

        $data=Yii::$app->db->createCommand("select * from subject inner join student on subject.student_id=student.id where subject.student_id=2;")->queryAll();
        // print_r($data);die;
        return $this->render("home",['data'=>$data]);
        $basic="pratham";
    }
}