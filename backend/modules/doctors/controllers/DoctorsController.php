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
use app\modules\doctors\models\DoctorSlots;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\ChangePasswordForm;

use app\modules\patients\models\DoctorNghPatient;
use yii\data\ActiveDataProvider;
use app\modules\patients\models\Patients;
use app\modules\patients\models\PatientInformation;
use app\modules\patients\models\DoctorNghPatientSearch;

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
       
       
       
       
       
       
       
        
        if ($model->load(Yii::$app->request->post()) )
        { 
        	
        	$model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	if($model->validate())
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
        	
        	 
        	if(!(empty($model->doctorImage)))
        	{
        		 
        		$imageName = time().$model->doctorImage->name;
        			
        		$model->doctorImage->saveAs('profileimages/'.$imageName );
        		 
        		$model->doctorImage = 'profileimages/'.$imageName;
        	}
        	$model->save();
        	//print_r($model->errors);exit();
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
        	
        	
        	 Yii::$app->session->setFlash('success', " Doctors Created successfully ");
            //return $this->redirect(['view', 'id' => $model->doctorid]);
            return $this->redirect(['index']);
        	}
        	else {
        		 return $this->render('create', [
                'model' => $model,
            	
            ]);
        	}
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
        $model->scenario = 'update';
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

        if ($model->load(Yii::$app->request->post()) )
        {
        	 $model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
        	 if($model->validate())
        	 {
        	 $model->updatedDate = date('Y-m-d H:i:s');
        	 $model->updatedBy = Yii::$app->user->identity->id;
        	 //echo $model->country;exit();
        	 $model->countryName = Countries::getCountryName($model->country);
        	 $model->stateName = States::getStateName($model->state);
        	 
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
        	 //print_r($model->doctorImage);exit();
        	 $model->save();
        	 //print_r($model->errors);exit();
        	 
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
        	 
        	
        	 Yii::$app->session->setFlash('success', " Doctors Updated successfully ");
            //return $this->redirect(['view', 'id' => $model->doctorid]);
            return $this->redirect(['index']);
        	 }
            
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
        //$this->findModel($id)->delete();
    	try{
    		$model = $this->findModel($id)->delete();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted Doctors.');
    		 
    	}
    	
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Doctor is not deleted.');
    		 
    	}
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
    public function actionSlots()
    {
    	$model = new DoctorSlots();
    	$model->slotsInfo = DoctorSlots::getSlotsInfo(Yii::$app->user->identity->id);
    	//print_r($model->slotsInfo);exit();
    	if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
    		Yii::$app->response->format = Response::FORMAT_JSON;
    		if (!$model->validate()) {
    			return ActiveForm::validate($model);
    		}
    		else
    		{
    			//print_r($model->slotsInfo);exit();
    			for($k =0 ; $k < count($model->slotsInfo); $k++)
    			{
    				if($model->slotsInfo[$k]['docslotId'] != '')
    				{
    					$slotId = $model->slotsInfo[$k]['docslotId'];
    					$updateSlotInfo = DoctorSlots::find()->where(['docslotId' => $slotId])->one();
    					$updateSlotInfo->day = $model->slotsInfo[$k]['day'];
    					$updateSlotInfo->startTime = $model->slotsInfo[$k]['startTime'];
    					$updateSlotInfo->endTime = $model->slotsInfo[$k]['endTime'];
    					$updateSlotInfo->dsDoctorId =  Yii::$app->user->identity->id;
    					$updateSlotInfo->save();
    				}
    				else{
    				$slotInfoModel = new DoctorSlots();
    				$slotInfoModel->day = $model->slotsInfo[$k]['day'];
    				$slotInfoModel->startTime = $model->slotsInfo[$k]['startTime'];
    				$slotInfoModel->endTime = $model->slotsInfo[$k]['endTime'];
    				$slotInfoModel->dsDoctorId =  Yii::$app->user->identity->id;
    				$slotInfoModel->save();
    				}
    			}
    			Yii::$app->getSession()->setFlash('success', 'created New  time slots.');
    			return $this->redirect(['slots']);
//     			/exit();
    		}
    		
    	} else {
    	return $this->render('slots', [
    			'model' => $model,
    	]);
    	}
    	
    }
    protected function finduserModel($uid)
    {
    	if (($usermodel = User::findOne($uid)) !== null) {
    		return $usermodel;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    public function actionProfileupdate($uid)
    {
    	$usermodel = $this->finduserModel($uid);
    	//print_r($usermodel->id);exit();
    	$model = Doctors::find()->where(['userId' =>$usermodel->id])->one();
    	//print_r($model);exit();
    	$model->scenario = 'profileupdate';
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
    
    	if ($model->load(Yii::$app->request->post()) )
    	{
    		$model->doctorImage = UploadedFile::getInstance($model,'doctorImage');
    		if($model->validate())
    		{
    			$model->updatedDate = date('Y-m-d H:i:s');
    			$model->updatedBy = Yii::$app->user->identity->id;
    			//echo $model->country;exit();
    			$model->countryName = Countries::getCountryName($model->country);
    			$model->stateName = States::getStateName($model->state);
    
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
    			//print_r($model->doctorImage);exit();
    			$model->save();
    			//print_r($model->errors);exit();
    
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
    
    			 
    			Yii::$app->session->setFlash('success', " Doctors Updated successfully ");
    			//return $this->redirect(['view', 'id' => $model->doctorid]);
    			return $this->redirect(['profileview','uid' => $usermodel->id]);
    		}
    
    	} else {
    		return $this->render('profileupdate', [
    				'model' => $model,
    		]);
    	}
    }
    public function actionProfileview($uid)
    {
    	$usermodel = $this->finduserModel($uid);
    	//print_r($usermodel->id);exit();
    	$model = Doctors::find()->where(['userId' =>$usermodel->id])->one();
    	//print_r($model);exit();
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
    	 
    	return $this->render('profileview', [
    			'model' => $model,'docqualiary' =>$docqualiary,'docspeciary'=>$docspeciary,
    	]);
    }
    
    
    
    
    
    /**
     *  Reset Password
     */
    
    
    public function actionResetPassword($id)
    {
    	
    	try {
    		$model = new ChangePasswordForm();
    	} catch (InvalidParamException $e) {
    		throw new BadRequestHttpException($e->getMessage());
    	}
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword($id)) {
    		Yii::$app->getSession()->setFlash('success', 'New password was saved.');
    
    		return $this->redirect(['index']);;
    	}
    
    	return $this->render('resetPassword', [
    			'model' => $model,
    	]);
    	
    }
    
    public function actionPatientRequests()
    {
    	/* $docId = Yii::$app->user->identity->id;
    	$patientinfoModel = DoctorNghPatient::find()->select('doctor_ngh_patient.patientRequestStatus,doctor_ngh_patient.patientHistoryId,nursinghomes.nursingHomeName,patients.firstName,patients.lastName')->innerJoin('nursinghomes','doctor_ngh_patient.nugrsingId=nursinghomes.nuserId')->innerJoin('patient_information','doctor_ngh_patient.patientHistoryId=patient_information.patientInfoId')->innerJoin('patients','patient_information.patientId=patients.patientId')->where("doctor_ngh_patient.doctorId =".$docId);
    	$dataProvider = new ActiveDataProvider([
    			'query' => $patientinfoModel,
    			'sort' => ['attributes' => ['nursingHomeName','firstName','lastName','patientRequestStatus']],
    	]);
    	
    	return $this->render('patientRequests', [
    			'dataProvider' => $dataProvider,
    	]); */
    	
    	$searchModel = new DoctorNghPatientSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	return $this->render('patientRequests', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    	
    	//print_r($patientinfoModel);exit();
    }
    
    public function actionPatientInfo($phsId)
    {
    	$model = DoctorNghPatient::find()->where(['patientHistoryId' => $phsId])->one();
    	$model->scenario = 'requesttreatment';
    	$mpatientModel = new Patients();
    	$mpatientInformationModel = new PatientInformation();
    	$model->phsId = $phsId;
    	$pDate = date("Y-M-d H:i:s");
    	$presentDay = date("D", strtotime($pDate));
    	$presentTime =  date("H:i", strtotime($pDate));
    	$avialableDoctors = array();
    	//echo $presentTime;exit();
    	
    	 
    	$patientId = 0;
    	$nghId = 0;
    	$patientInfo = PatientInformation::find()->where(['patientInfoId' => $model->phsId])->one();
    	$patientId = $patientInfo->patientId;
    	if($patientId !=0)
    	{
    		$mpatientInformationModel = $patientInfo;
    		$nghInfo = Patients::find()->where(['patientId' => $patientId])->one();
    		$nghId = $nghInfo->createdBy;
    		$mpatientModel = $nghInfo;
    	}
    	 
    	 
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		$model->patientRequestStatus = 'Completed';
    		$model->update();
    
    		//$prmodel = new PatientRequests();
    		
    		
    			return $this->redirect(['patient-requests']);
    		
    		//print_r($nghId);exit();
    	}
    	/* else{
    		print_r($model->errors);exit();
    	} */
    	 
    	return $this->render('patientInfo',
    			['model' => $model,'mpatientModel' => $mpatientModel,'mpatientInformationModel' => $mpatientInformationModel]);
    	//print_r($avialableDoctors);exit();
    }
    
}
