<?php

namespace app\modules\patients\controllers;

use Yii;
use app\modules\patients\models\Patients;
use app\modules\patients\models\PatientsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Countries;
use app\models\States;
use yii\helpers\Json;
use app\modules\patients\models\PatientInformation;

/**
 * PatientsController implements the CRUD actions for Patients model.
 */
class PatientsController extends Controller
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
     * Lists all Patients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Patients model.
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
     * Creates a new Patients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patients();
        
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->state=States::getCountrysByStatesView($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }

        if ($model->load(Yii::$app->request->post())) {
        	
        	
        	$presentDate = date('Y-m-d');
        	$patientscount = Patients::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	 exit(); */
        	$addnewid = $patientscount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'PAT'.$dayval.$monthval.$dateInfo['year'];
        	 
        	$model->patientUniqueId = $overallUniqueId;
        	//print_r($model->patientUniqueId);exit();
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->dateOfBirth = date('Y-m-d', strtotime($model->dateOfBirth));
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->IPRegistrationDate = date('Y-m-d', strtotime($model->IPRegistrationDate));
        	$model->cardIssuedDate = date('Y-m-d', strtotime($model->cardIssuedDate));
        	//print_r($model->cardIssuedDate);exit();
        	$model->save();
        	
        	$patmodel = new PatientInformation();
        	
           // return $this->redirect(['view', 'id' => $model->patientId]);
        	$patmodel->patientId = $model->patientId;
        	//print_r($patmodel->patientId);exit();
        	$patmodel->height = $model->height;
        	$patmodel->weight = $model->weight;
        	$patmodel->BMI = $model->BMI;
        	$patmodel->respirationRate = $model->respirationRate;
        	$patmodel->BPLeftArm = $model->BPLeftArm;
        	$patmodel->BPRightArm = $model->BPRightArm;
        	$patmodel->pulseRate = $model->pulseRate;
        	$patmodel->temparatureType = $model->temparatureType;
        	$patmodel->pallor = $model->pallor;
        	$patmodel->lymphadenopathy = $model->lymphadenopathy;
        	$patmodel->oedemaInFeet = $model->oedemaInFeet;
        	$patmodel->malnutrition = $model->malnutrition;
        	$patmodel->cyanosis = $model->cyanosis;
        	$patmodel->clubbingFingersToes = $model->clubbingFingersToes;
        	$patmodel->dehydration = $model->dehydration;
        	$patmodel->diseases = $model->diseases;
        	$patmodel->addictions = $model->addictions;
        	$patmodel->allergicMedicine = $model->allergicMedicine;
        	$patmodel->allergicSubstance = $model->allergicSubstance;
        	$patmodel->admissionType = $model->admissionType;
        	$patmodel->admissionDate =  date('Y-m-d', strtotime($model->admissionDate));;
        	$patmodel->createdDate = date('Y-m-d H:i:s');
        	 
        	$patmodel->save();
        	
        	
        	
        	
        	return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Patients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->countriesList = Countries::getCountries();
       
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
        
        if ($model->load(Yii::$app->request->post())) {
        	
        	
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->save();
            //return $this->redirect(['view', 'id' => $model->patientId]);
        	return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patients model.
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
     * Finds the Patients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patients::findOne($id)) !== null) {
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
