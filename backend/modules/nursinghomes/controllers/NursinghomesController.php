<?php
namespace app\modules\nursinghomes\controllers;


use Yii;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\nursinghomes\models\NursinghomesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\User;

/**
 * NursinghomesController implements the CRUD actions for Nursinghomes model.
 */
class NursinghomesController extends Controller
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
     * Lists all Nursinghomes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NursinghomesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nursinghomes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = new User ();
         $model = User::find() ->where(['id' => $id])->one();
    	
            //$user = User::find() ->where(['id' =>yii::$app->user->id])->one();
           	//print_r(yii::$app->user->id);exit;
           	
    	 $model = $this->findModel($id);
      if (!$model) {
    		throw new NotFoundHttpException('model not found');
    	}
        return $this->render('view', [
            'model' => $this->findModel($id),
        	 // 'model' => $model,
        		
        ]);
    }

    /**
     * Creates a new Nursinghomes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nursinghomes();
        $usermodel = new User();
        $model->scenario = 'create';
            
        if ($model->load(Yii::$app->request->post()))
        {
        	        	
        	$usermodel->username = $model->username;
        	$usermodel->email = $model->email;
        	$usermodel->password_hash = md5($model->password);
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->stateName = 'stateName';
        	$model->countryName = 'countryName';
        	//$model->updatedBy = Yii::$app->user->userid;
        	
        	$model->save();
        	$usermodel->save();
        	
        
           return $this->redirect(['view', 'id' => $model->nursingId]);
                 
        } else {
            return $this->render('create', [
                'model' => $model,
            	'usermodel' => $usermodel,
            ]);
        }
    }

    /**
     * Updates an existing Nursinghomes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usermodell = new User();
    
       $usermodel = User::find() ->where(['id' =>$id])->one();
        
        if (! (empty ( $usermodel ))) {
            $model->username = $usermodel->username;
        	$model->email = $usermodel->email;
        	        }
      
          //if ($model->load(Yii::$app->request->post())){ 
          	if (($model->load ( Yii::$app->request->post () )) && ($model->validate ())) {
          		$model->stateName = 'stateName';
          		$model->countryName = 'countryName';
          		$model->updatedDate = date('Y-m-d H:i:s');
          		$model->save();
          		
          		if(!(empty($usermodel))){
          			$usermodel->username = $model->username;
          			$usermodel->email = $model->email;
          			$usermodel->save();
          			
          		}else {
          			$usermodell->username = $model->username;
          			$usermodell->email = $model->email;
          			$usermodell->save();
          			
          		}
          	
            return $this->redirect(['view', 'id' => $model->nursingId]);
        } else {
            return $this->render('update', [
                'model' => $model,

            ]);
        }
    }

    /**
     * Deletes an existing Nursinghomes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nursinghomes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Nursinghomes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nursinghomes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
