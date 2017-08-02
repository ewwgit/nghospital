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
use backend\models\SignupConvertForm;
use app\modules\nursinghomes\models\Nursinghomes;

use app\models\UserrolesModel;
use yii\filters\AccessControl;
use app\models\ModulePermissions;

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
	
		$permissionsArray = [''];
		if(UserrolesModel::getRole() == 1)
		{
			$permissionsArray = ['index','create','update','view','delete','convert-nursinghomes'];
		}
		else {
			$modulePermissions = ModulePermissions::find()->where(['moduleId' =>4,'adminuserId'=> Yii::$app->user->identity->id])->one();
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
								'index','create','update','view','delete','convert-doctors'
	
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
        	    $model->status = 'Active';
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
    		//$model = $this->findModel($id)->delete();
    		$insnghinfo = IntrestedNghs::find()->where(['insnghid' => $id])->one();
    		$insnghinfo->status ='In-active';
    		$insnghinfo->update();
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
    
    public function actionConvertNursinghomes($id)
    {
        $interestednghInfo = Intrestednghs::find()->where(['insnghid' => $id])->one();
    	$model = new SignupConvertForm();
    	$model->email =  $interestednghInfo->email;
    	$model->name =  $interestednghInfo->name;
    	$nursinghomeModel = new Nursinghomes();
    	$nursinghomeModel->scenario = 'convertsneed';
    	$model->scenario = 'interested';
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate()){
    		$model->role= 3;
    		$userData = $model->signup();
    		$presentDate = date('Y-m-d');
    		$nursinghomescount = Nursinghomes::find()->where("createdDate LIKE '$presentDate%'")->count();
    		/* echo $nursinghomescount;
    		 exit(); */
    		
    		$addnewid = $nursinghomescount+1;
    		$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
    		$dateInfo = date_parse(date('Y-m-d H:i:s'));
    		$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
    		$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
    		$overallUniqueId = $uniqonlyId.'NGH'.$dayval.$monthval.$dateInfo['year'];
    		$nursinghomeModel->nurshingUniqueId = $overallUniqueId;
    		$nursinghomeModel->nuserId = $userData->id;
    		$nursinghomeModel->description = $interestednghInfo->description;
    		$nursinghomeModel->createdDate = date('Y-m-d H:i:s');
    		$nursinghomeModel->updatedDate = date('Y-m-d H:i:s');
    		$nursinghomeModel->createdBy = Yii::$app->user->identity->id;
    		$nursinghomeModel->updatedBy = Yii::$app->user->identity->id;
    		$nursinghomeModel->nursingHomeName = $model->name;    		
    		$nursinghomeModel->save();
    		if($nursinghomeModel)
    		{
    			Intrestednghs::deleteAll(['insnghid'=> $id]);
    		}
    		//print_r($nursinghomeModel->errors);exit();
    		Yii::$app->session->setFlash('success', "Converted User to Nursing Homes Successfully ");
    		return $this->redirect(['index']);
    	} else {
    		return $this->render('nursinghomes', [
    				'model' => $model,
    		]);
    	}
    
    }
}
