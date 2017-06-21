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
use backend\models\SignupForm;
use app\modules\doctors\models\DoctorsQualification;
use app\modules\qualifications\models\Qualifications;
use app\modules\doctors\models\DoctorsSpecialities;
use app\modules\specialities\models\Specialities;

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
    	$model = $this->findModel($id);
    	$doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $model->userId])->all();
    	//print_r($doctorQulification);exit();
    	$dqary = array();
    	$docqualiary = array();
    	if(!empty($doctorQulification))
    	{
    		foreach ($doctorQulification as $dq)
    		{
    			$dqary[] = $dq->qualification;
    	
    		}
    	}
    	for($k=0; $k<count($dqary); $k++)
    	{
    		$docquali = Qualifications::find()->select('qualification')->where( ['qlid' => $dqary[$k]])->asArray()->one();
    		$docqualiary[] = $docquali['qualification'];
    		 
    	}
    	$docSpecialities = DoctorsSpecialities::find()->select('rspId')->where( ['rdoctorId' => $model->userId])->all();
    	//print_r($docSpecialities);exit();
    	$dsary = array();
    	$docspeciary = array();
    	if(!empty($docSpecialities))
    	{
    		foreach ($docSpecialities as $ds)
    		{
    			$dsary[] = $ds->rspId;
    	
    		}
    	}
    	//print_r($dsary);exit();
    	for($m=0; $m<count($dsary); $m++)
    	{
    		$docspeci = Specialities::find()->select('specialityName')->where( ['spId' => $dsary[$m]])->asArray()->one();
    		$docspeciary[] = $docspeci['specialityName'];
    	}
    	
    	
    	//$model->qualification = $docqualiary;
    	
        return $this->render('view', [
            'model' => $this->findModel($id),'docqualiary' =>$docqualiary,'docspeciary'=>$docspeciary,
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
        $singupModel = new SignupForm();
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
        
       
       //$qualificationData = Qualifications::find()->select('qualification')->asArray()->where(['status' => 'Active'])->all();
       //$model ->allquali = $qualificationData;
       //print_r($model ->allquali);exit();
       
       
       
       $qualificationData = Qualifications::find()
       ->select('qualification')->where(['status' => 'Active'])
       ->all();
        
       $qualiInfo = array();
       if(!empty($qualificationData))
       {
       	foreach ($qualificationData as $qualinew)
       	{
       		//echo rtrim($skillnew->skills,",");
       		$aryconvertquali = explode(",",rtrim($qualinew->qualification,","));
       		for($m=0; $m < count($aryconvertquali); $m++)
       		{
       			$qualiInfo["$aryconvertquali[$m]"] = $aryconvertquali[$m];
       		}
       	}
       }
       else {
       	$qualiInfo =[''];
       }
       
       $model ->allQuali = $qualiInfo;
       //print_r($qualiInfo);exit();
       
       
       
       $specialityData = Specialities::find()
       ->select('specialityName')->where(['status' => 'Active'])
       ->all();
       
       $speciInfo = array();
       if(!empty($specialityData))
       {
       	foreach ($specialityData as $specinew)
       	{
       		//echo rtrim($skillnew->skills,",");
       		$aryconvertspeci = explode(",",rtrim($specinew->specialityName,","));
       		for($m=0; $m < count($aryconvertspeci); $m++)
       		{
       			$speciInfo["$aryconvertspeci[$m]"] = $aryconvertspeci[$m];
       		}
       	}
       }
       else {
       	$speciInfo =[''];
       }
       $model ->allSpeci = $speciInfo;
       
       
       
       
       
       
       
        
        if ($model->load(Yii::$app->request->post()) && $model->validate() )
        { 
        	$singupModel->username = $model->username;
        	$singupModel->email = $model->email;
        	$singupModel->password = $model->password;
        	$singupModel->role = 2;
        	$user = $singupModel->signup();
        	$model->email = 'dummy@mailinator.com';
        	$model->username = 'dummy';
        	
        	$presentDate = date('Y-m-d');
        	$doctorscount = Doctors::find()->where("createdDate LIKE '$presentDate%'")->count();
        	/* echo $nursinghomescount;
        	 exit(); */
        	$addnewid = $doctorscount+1;
        	$uniqonlyId = str_pad($addnewid, 5, '0', STR_PAD_LEFT);
        	$dateInfo = date_parse(date('Y-m-d H:i:s'));
        	$monthval = str_pad($dateInfo['month'], 2, '0', STR_PAD_LEFT);
        	$dayval = str_pad($dateInfo['day'], 2, '0', STR_PAD_LEFT);
        	$overallUniqueId = $uniqonlyId.'DOC'.$dayval.$monthval.$dateInfo['year'];
        	
        	$model->createdDate = date('Y-m-d H:i:s');
        	$model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->userId = $user->id;
        	$model->doctorUniqueId = $overallUniqueId;
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;
        	$model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	 
        	if(!(empty($model->doctorImage)))
        	{
        		 
        		$imageName = time().$model->doctorImage->name;
        			
        		$model->doctorImage->saveAs('profileimages/'.$imageName );
        		 
        		$model->doctorImage = 'profileimages/'.$imageName;
        	}
        	$model->save();
        	for($i=0; $i<count($model->qualification);$i++)
        	{
        		$qulificationInfo = Qualifications::find()->select(['qlid'])->where(['qualification' => $model->qualification[$i]])->one();
        		if(!empty($qulificationInfo))
        		{
        		$dqualification = new DoctorsQualification();
        		$dqualification->docId = $model->userId;
        		$dqualification->qualification = $qulificationInfo->qlid;
        		$dqualification->save();
        		}
        	
        	
        	}
        	
        	
             for($k=0; $k<count($model->specialities);$k++)
        	 {
        	 	$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities[$k]])->asArray()->one();
        	 	if(!empty($specid))
        	 	{
        	 		$dspeciality = new DoctorsSpecialities();
        	 		$dspeciality->rdoctorId = $model->userId;
        	 		$dspeciality->rspId =$specid['spId'];
        	 		$dspeciality->save();
        	 	}
        	 		 
        	 		 
        	 	
        	 }
        	
        	
        	
            //return $this->redirect(['view', 'id' => $model->doctorid]);
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            	
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
        $singupModel = new SignupForm();
        $doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $model->userId])->all();
        //print_r($doctorQulification);exit();
        $dqary = array();
        $docqualiary = array();
        if(!empty($doctorQulification))
        {
        	foreach ($doctorQulification as $dq)
        	{
        		$dqary[] = $dq->qualification;
        		
        	}
        }
        for($k=0; $k<count($dqary); $k++)
        {
        	$docquali = Qualifications::find()->select('qualification')->where( ['qlid' => $dqary[$k]])->asArray()->one();
        	$docqualiary[] = $docquali['qualification'];
        	
        }
        $model->qualification = $docqualiary;
        
        $docSpecialities = DoctorsSpecialities::find()->select('rspId')->where( ['rdoctorId' => $model->userId])->all();
        //print_r($docSpecialities);exit();
        $dsary = array();
        $docspeciary = array();
        if(!empty($docSpecialities))
        {
        	foreach ($docSpecialities as $ds)
        	{
        		$dsary[] = $ds->rspId;
        
        	}
        }
        //print_r($dsary);exit();
        for($m=0; $m<count($dsary); $m++)
        {
        	$docspeci = Specialities::find()->select('specialityName')->where( ['spId' => $dsary[$m]])->asArray()->one();
        	$docspeciary[] = $docspeci['specialityName'];
        	 
        }
        $model->specialities = $docspeciary;
      
        
        $model->countriesList = Countries::getCountries();
        $model->docimageupdate = $model->doctorImage;
        $model->doctorImage = '';
        $model->citiesData = [];
        
        if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	$model->statesData =[];
        	$model->state='';
        }
        
        
        $qualificationData = Qualifications::find()
        ->select('qualification')->where(['status' => 'Active'])
        ->all();
        
        $qualiInfo = array();
        if(!empty($qualificationData))
        {
        	foreach ($qualificationData as $qualinew)
        	{
        		//echo rtrim($skillnew->skills,",");
        		$aryconvertquali = explode(",",rtrim($qualinew->qualification,","));
        		for($m=0; $m < count($aryconvertquali); $m++)
        		{
        			$qualiInfo["$aryconvertquali[$m]"] = $aryconvertquali[$m];
        		}
        	}
        }
        else {
        	$qualiInfo =[''];
        }
        $model ->allQuali = $qualiInfo;
        
        
        $specialityData = Specialities::find()
        ->select('specialityName')->where(['status' => 'Active'])
        ->all();
         
        $speciInfo = array();
        if(!empty($specialityData))
        {
        	foreach ($specialityData as $specinew)
        	{
        		//echo rtrim($skillnew->skills,",");
        		$aryconvertspeci = explode(",",rtrim($specinew->specialityName,","));
        		for($m=0; $m < count($aryconvertspeci); $m++)
        		{
        			$speciInfo["$aryconvertspeci[$m]"] = $aryconvertspeci[$m];
        		}
        	}
        }
        else {
        	$speciInfo =[''];
        }
        $model ->allSpeci = $speciInfo;
        
        
        $usermodel = User::find() ->where(['id' =>$model->userId])->one();
        
        if (! (empty ( $usermodel ))) {
        	$model->username = $usermodel->username;
        	$model->email = $usermodel->email;
        	$model->status = $usermodel->status;
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
        	
        	 $model->updatedDate = date('Y-m-d H:i:s');
        	 $model->updatedBy = Yii::$app->user->identity->id;
        	 //echo $model->country;exit();
        	 $model->countryName = Countries::getCountryName($model->country);
        	 $model->stateName = States::getStateName($model->state);
        	 $model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	 $usermodel->status = $model->status;
        	 $usermodel->save();
        	 //print_r($model->doctorImage);exit();
        	 
        	 if(!(empty($model->doctorImage)))
        	 {
        	 	 
        	 	$imageName = time().$model->doctorImage->name;
        	 	 
        	 	$model->doctorImage->saveAs('profileimages/'.$imageName );
        	 	 
        	 	$model->doctorImage = 'profileimages/'.$imageName;
        	 }
        	 else {
        	 	$model->doctorImage = $model->docimageupdate; 
        	 }
        	 $model->save();
        	 
        	 DoctorsQualification::deleteAll( ['docId' => $model->userId]);
        	 if(!empty($model->qualification))
        	 {
        	 	for($i=0; $i<count($model->qualification);$i++)
        	 	{
        	 	$qulificationInfo = Qualifications::find()->select(['qlid'])->where(['qualification' => $model->qualification[$i]])->one();
        		if(!empty($qulificationInfo))
        		{
        		$dqualification = new DoctorsQualification();
        		$dqualification->docId = $model->userId;
        		$dqualification->qualification = $qulificationInfo->qlid;
        		$dqualification->save();
        		}
        	 		
        	 		
        	 	}
        	 }
        	 
        	 
        	 DoctorsSpecialities::deleteAll( ['rdoctorId' => $model->userId]);
        	 for($k=0; $k<count($model->specialities);$k++)
        	 {
        	 	$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities[$k]])->asArray()->one();
        	 	if(!empty($specid))
        	 	{
        	 		$dspeciality = new DoctorsSpecialities();
        	 		$dspeciality->rdoctorId = $model->userId;
        	 		$dspeciality->rspId =$specid['spId'];
        	 		$dspeciality->save();
        	 	}
        	 		 
        	 		 
        	 	
        	 }
        	 //print_r($model->qualification);exit();
        	 
        	
        
            //return $this->redirect(['view', 'id' => $model->doctorid]);
            return $this->redirect(['index']);
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
