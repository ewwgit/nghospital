<?php

namespace app\modules\doctors\controllers;

use Yii;
use app\modules\doctors\models\Doctors;
use app\modules\doctors\models\DoctorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\web\UploadedFile;
use app\models\Countries;
use app\models\States;
use yii\helpers\Json;

/**
 * DoctorsController implements the CRUD actions for Doctors model.
 */
class DoctorsController extends Controller
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
     * Lists all Doctors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoctorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doctors model.
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
     * Creates a new Doctors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Doctors();
        $usermodel = new User();
        $model->scenario = 'create';//password validation only show create  form//
        
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        
        if($model->country != ''){
        	 
        	$model->state=States::getCountrysByStatesView($model->country );
        	 
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
        

        if ($model->load(Yii::$app->request->post()))
        { 
        	
        	$usermodel->username = $model->username;    
        	$usermodel->email = $model->email;
        	$usermodel->password_hash = md5($model->password);
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model -> stateName = States::getStateName($model->state);
        	$model->userId = 1;
        	$model->doctorUniqueId = 'doctorUniqueId';
        	$model->createdBy = 1;
        	$model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	 
        	if(!(empty($model->doctorImage)))
        	{
        		 
        		$imageName = time().$model->doctorImage->name;
        			
        		$model->doctorImage->saveAs('profileimages/'.$imageName );
        		 
        		$model->doctorImage = 'profileimages/'.$imageName;
        	}
        	$model->save();
        	$usermodel->save();
            return $this->redirect(['view', 'id' => $model->doctorid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'usermodel' => $usermodel,
            ]);
        }
    }

    /**
     * Updates an existing Doctors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $usermodell = new User();
        
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->state=States::getCountrysByStatesView($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
        
        $usermodel = User::find() ->where(['id' =>$id])->one();
        
        if (! (empty ( $usermodel ))) {
        	$model->username = $usermodel->username;
        	$model->email = $usermodel->email;
        }

        if ($model->load(Yii::$app->request->post()))
        {
        	
        	 $model->updatedDate = date('Y-m-d H:i:s');
        	 $model->updatedBy = 1;
        	 $model->countryName = Countries::getCountryName($model->country);
        	 $model->stateName = States::getStateName($model->state);
        	 $model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	 
        	 if(!(empty($model->doctorImage)))
        	 {
        	 	 
        	 	$imageName = time().$model->doctorImage->name;
        	 	 
        	 	$model->doctorImage->saveAs('profileimages/'.$imageName );
        	 	 
        	 	$model->doctorImage = 'profileimages/'.$imageName;
        	 }
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
        
            return $this->redirect(['view', 'id' => $model->doctorid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Doctors model.
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
     * Finds the Doctors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Doctors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Doctors::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionStates()
    {
    
    	$out = [];
    	if (isset($_POST['depdrop_parents'])) {
    		$parents = $_POST['depdrop_parents'];
    
    		if ($parents != null) {
    			$country = $parents[0];
    			$states = Countries::getStatesByCountry($country);
    			/* $out = [
    			 ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
    			 ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
    
    			]; */
    			echo Json::encode(['output'=>$states, 'selected'=>0]);
    			return;
    
    
    		}
    	}
    
    	echo Json::encode(['output'=>'', 'selected'=>'']);
    
    
    }
}
