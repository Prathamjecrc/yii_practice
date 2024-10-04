<?php

namespace app\controllers;

use Yii;
use app\models\City;
use app\models\Name;
use app\models\State;
use app\models\Country;
use app\models\Student;
use app\models\Language;

class DemoController extends \yii\web\Controller
{
    // public function actionIndex()
    // {


    //     //insert///

    //     // $data=new Student();
    //     // $data->name="ankur";
    //     // $data->class= "20";
    //     // $data->house= "yellow";
    //     // $data->save();


    //     //update//


    //     // $data = Student::find()->where( 'id',5);
    //     // echo $data->createCommand()->getRawSql();
    //     // echo "<pre/>";print_r($data);die;
    //     // // foreach ($data as  $value) {
    //     // //     $value->name = "hitensssssssss";
    //     // //     $value->save();
    //     // // }

    //     // //update - 2//
    //     // $data = Student::find()->select('*')->where(['id'=>[5,6]]);
    //     // echo $data->createCommand()->getRawSql();die;
    //     // echo "<pre/>";print_r($data);die;

    //     // foreach ($data as  $value) {
    //     //     $value->name = "hitensssssssss";
    //     //     $value->save();
    //     // }


    //     // echo "yes";
    //     // die;
    //     return $this->render('index');
    // }



    // public function actionIndex()
    // {
    //     $nameModel = new Name();
    //     $languageModel = new Language();
    //     $cityModel = new City();
    //     $latestData = null;


    //     if (Yii::$app->request->isPost) {
    //         $transaction = Yii::$app->db->beginTransaction();
    //         try {
               
    //             if ($nameModel->load(Yii::$app->request->post()) && $nameModel->save()) {
                     
    //                 $languageModel->name_id = $nameModel->id;  
    //                 if ($languageModel->load(Yii::$app->request->post()) && $languageModel->save()) {
                       
    //                     $cityModel->name_id = $nameModel->id;      
    //                     $cityModel->language_id = $languageModel->id; 
    //                     if ($cityModel->load( Yii::$app->request->post()) && $cityModel->save()) {
                            
    //                         $transaction->commit();
    //                         $latestData = (object) [
    //                             'name' => $nameModel->name,
    //                             'city' => $cityModel->city,
    //                             'language' => $languageModel->language
    //                         ];

    //                         $nameModel->name = '';
    //                         $languageModel->language = '';
    //                         $cityModel->city = '';
                           
    //                     }
    //                 }
    //             }
    //             // If any of the saves failed, rollback the transaction
    //             $transaction->rollBack();
    //         } catch (\Exception $e) {
    //             $transaction->rollBack();
    //             throw $e;
    //         }
    //     }

    //     return $this->render('index', [
    //         'nameModel' => $nameModel,
    //         'languageModel' => $languageModel,
    //         'cityModel' => $cityModel,
    //         'latestData' => $latestData,
    //     ]);
    // }

    public function actionIndex()
{
    $nameModel = new Name();
    $countryModel = new Country();
    $stateModel = new State();
    $cityModel = new City();
    $latestData=null;
    if ($nameModel->load(Yii::$app->request->post()) && $countryModel->load(Yii::$app->request->post()) && $cityModel->load(Yii::$app->request->post())&& $stateModel->load(Yii::$app->request->post())) {
        $nameModel->save();
        $countryModel->name_id = $nameModel->id;
        $countryModel->save();
        $stateModel->name_id = $nameModel->id;
        $stateModel->country_id = $countryModel->id;
        $stateModel->save();
        $cityModel->name_id = $nameModel->id;
        $cityModel->country_id = $countryModel->id;
        $cityModel->state_id = $stateModel->id;
        $cityModel->save();


        // echo "<pre/>";
        // print_r($cityModel);die;
        // Set flash message
        Yii::$app->session->setFlash('success', [
            'name' => $cityModel->name->name,
            'country' => $cityModel->country->country,
            'state' => $cityModel->state->state,
            'city' => $cityModel->city,
        ]);

        Yii::$app->session->setFlash('success', [
            'name' => $nameModel->name,
            'country' => $countryModel->country,
            'state' => $stateModel->state,
            'city' => $cityModel->city,
        ]);
        
        return $this->redirect(['index']); 

    }

    // $latestData = City::find()->joinWith('name')->joinWith('country')->orderBy(['id' => SORT_DESC])->one();
    return $this->render('index', [
        'nameModel' => $nameModel,
        'countryModel' => $countryModel,
        'stateModel' => $stateModel,
        'cityModel' => $cityModel,
        // 'latestData' => $latestData
    ]);
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
