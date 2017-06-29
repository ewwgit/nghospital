<?php

namespace app\modules\intrestednursinghomes\controllers;

use Yii;
use app\modules\intrestednursinghomes\models\Intrestednghs;
use app\modules\intrestednursinghomes\models\IntrestednghsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Role;
use yii\helpers\ArrayHelper;

/**
 * IntrestednghsController implements the CRUD actions for Intrestednghs model.
 */
class IntrestednghsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Intrestednghs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IntrestednghsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Intrestednghs model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new Intrestednghs();
    	$role_insn = IntrestedNghs::find()->where(['insnghid' => $id])->one();
    	
    	if(!empty($role_insn)){
    		
    		$model->role = $role_insn->role;
    		$roleName = Role::find()->select('RoleName')->where( ['RoleId' => $model->role])->one();
    		$datas = ArrayHelper::toArray($roleName, ['RoleName']);
    		$data=implode($datas);
    		$model->role = $data;
    	
    	}
        return $this->render('view', [
            'model' => $this->findModel($id),
        		'data' =>$data,
        ]);
    }

    /**
     * Creates a new Intrestednghs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Intrestednghs();

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
        	    $model->createdDate = date('Y-m-d H:i:s');
        	    $model->role = 3;
        		$model->save() ;
        		Yii::$app->session->setFlash('success', " Interested Nursing Homes Created successfully ");
            return $this->redirect(['view', 'id' => $model->insnghid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Intrestednghs model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
        	
        	 $model->role = 3;
        	 $model->save();
        	 Yii::$app->session->setFlash('success', " Interested Nursing Homes Updated successfully ");
            return $this->redirect(['view', 'id' => $model->insnghid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Intrestednghs model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Interested Nursing Home.');
    		 
    	}
    	 
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Interested Nursing Home is not deleted.');
    		 
    	}

        return $this->redirect(['index']);
    }

    /**
     * Finds the Intrestednghs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Intrestednghs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Intrestednghs::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
