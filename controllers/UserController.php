<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;
use app\models\UserSearch;
use app\models\SubEmployee;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['view', 'index', 'update', 'sub-update'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['view', 'index', 'update', 'sub-update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $user = Yii::$app->user->identity;

        // If the logged-in user is an employee, show only their record
        $dataProvider = ($user->role === 'employee') 
            ? $searchModel->search(['UserSearch' => ['id' => $user->id]])
            : $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $user = Yii::$app->user->identity;

    if ($user->role === 'employee') {
        if ($id != $user->id) {
            Yii::$app->session->setFlash('error', 'You are not authorized to view this Sub Employee.');
            return $this->redirect(['index']);
        }
    } else {
        // For admin or other roles, allow viewing the SubEmployee record with the given employee id
        $subEmployee = SubEmployee::findOne(['employee_id' => $id]);

        if ($subEmployee === null) {
            throw new NotFoundHttpException('The requested Sub Employee does not exist.');
        }
    }
    
        // Render the view using the renderSubEmployeeView helper function
        return $this->renderSubEmployeeView($id);
    }
    
    

 
    public function actionSubCreate($id)
    {
        $model = new SubEmployee();
        $model->employee_id = $id;
        $model->role = 'Sub_employee'; 

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->renderSubEmployeeView($id);
        }

        return $this->render('sub_create', [
            'model' => $model,
        ]);
    }

    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $user = Yii::$app->user->identity;

        $employeeId= $model->id;
        // If the logged-in user is an employee, they can only update their own record
        if ($user->role === 'employee' && $model->id !== $user->id) {
            Yii::$app->session->setFlash('error', 'You are not authorized to update this Employee.');
            return $this->redirect(['index']);
        }

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            // $model->profile_image = UploadedFile::getInstance($model, 'profile_image');

            // Check if model saved successfully
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'employeeId'=>$employeeId,
        ]);
    }

    public function actionSubUpdate($id)
    {
        $model = $this->SubfindModel($id);
        $user = Yii::$app->user->identity;
        $employeeId= $model->id;
        // If the logged-in user is an employee, they can only update their own sub employee record
        if ($user->role === 'employee' && $model->employee_id !== $user->id) {
            Yii::$app->session->setFlash('error', 'You are not authorized to update this Sub Employee.');
            return $this->renderSubEmployeeView($user->id);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->renderSubEmployeeView($model->employee_id);
        }

        return $this->render('update', [
            'model' => $model,
            'employeeId'=>$employeeId,
        ]);
    }

   
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if (SubEmployee::find()->where(['employee_id' => $id])->exists()) {
            Yii::$app->session->setFlash('error', 'Cannot delete this employee. Please delete the related SubEmployee(s) first.');
            return $this->redirect(['view', 'id' => $id]);
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    public function actionSubDelete($id)
    {
        $model = $this->SubfindModel($id);
        $employeeId = $model->employee_id;
        $model->delete();

        return $this->redirect(['view', 'id' => $employeeId]);
    }


    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function SubfindModel($id)
    {
        if (($model = SubEmployee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function renderSubEmployeeView($id)
    {
        $searchModel = new SubEmployee();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employee_id' => $id,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
       
                $model->role = 'employee'; // Set the role as 'employee'

                if ($model->save()) {
                    return Yii::$app->response->redirect(['user/index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
