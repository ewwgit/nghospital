<?php

namespace app\modules\intresteddoctors\controllers;

use Yii;
use app\modules\intresteddoctors\models\Intresteddoctors;
use app\modules\intresteddoctors\models\IntresteddoctorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UserrolesModel;
use yii\filters\AccessControl;
use app\models\ModulePermissions;

/**
 * IntresteddoctorsController implements the CRUD actions for Intresteddoctors model.
 */
class IntresteddoctorsController extends Controller
{
    /**
     * @inheritdoc
     */
    /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    } */
	
	public function behaviors()
	{
	
		$permissionsArray = [''];
		if(UserrolesModel::getRole() == 1)
		{
			$permissionsArray = ['index','create','update','view','delete'];
		}
		else {
			$modulePermissions = ModulePermissions::find()->where(['moduleId' =>7,'adminuserId'=> Yii::$app->user->identity->id])->one();
			if($modulePermissions['permissions_all'] == 1)
			{
				$permissionsArray = ['index','create','update','view','delete'];
			}
			else {
				if($modulePermissions['permissions_add'] == 1)
				{
					$permissionAdd = ['create'];
					$permissionsArray = array_merge($permissionsArray,$permissionAdd);
				}
				if($modulePermissions['permissions_edit'] == 1)
				{
					$permissionEdit = ['update'];
					$permissionsArray = array_merge($permissionsArray,$permissionEdit);
				}
				if($modulePermissions['permissions_delete'] == 1)
				{
					$permissionDelete = ['delete'];
					$permissionsArray = array_merge($permissionsArray,$permissionDelete);
				}
				if($modulePermissions['permissions_view'] == 1)
				{
					$permissionView = ['index','view'];
					$permissionsArray = array_merge($permissionsArray,$permissionView);
				}
	
			}
		}
		//print_r($permissionsArray);exit();
		return [
				'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
								'delete' => ['post'],
						],
				],
				'access' => [
						'class' => AccessControl::className(),
						'only' => [
								'index','create','update','view','delete','brandsupload'
	
						],
						'rules' => [
								[
										'actions' => $permissionsArray,
										'allow' => true,
										'matchCallback' => function ($rule, $action) {
										return (UserrolesModel::getRole());
										}
										],
	
										]
										]
										];
	}
	

    /**
     * Lists all Intresteddoctors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntresteddoctorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intresteddoctors model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Intresteddoctors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Intresteddoctors();

        if ($model->load(Yii::$app->request->post())) {
        	
        	$model->role = 2;
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->save();
        	Yii::$app->session->setFlash('success', " Interested Doctors Created successfully ");
            //return $this->redirect(['view', 'id' => $model->insdocid]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Intresteddoctors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	Yii::$app->session->setFlash('success', " Interested Doctors Updated successfully ");
            return $this->redirect(['view', 'id' => $model->insdocid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Intresteddoctors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       // $this->findModel($id)->delete();
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Interested Doctor.');
    		 
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Interested Doctor is not deleted.');
    		 
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intresteddoctors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Intresteddoctors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intresteddoctors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
