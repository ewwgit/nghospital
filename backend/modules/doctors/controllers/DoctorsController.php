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
use app\modules\patients\models\PatientsSearch;
use app\modules\patients\models\PatientInformation;
use app\modules\patients\models\DoctorNghPatientSearch;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\nursinghomes\models\NursinghomesSearch;
use app\models\UserrolesModel;
use yii\filters\AccessControl;
use app\models\ModulePermissions;
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
		$permissionsArray = [''];
		if(UserrolesModel::getRole() == 1)
		{
			$permissionsArray = ['index','create','update','view','delete','reset-password','states','patient-consultant-report','patient-info','previousrecords','patientshistoryview'];
		}
		elseif(UserrolesModel::getRole() == 2)
		{
			$permissionsArray = ['profileupdate','profileview','patient-requests','reset-password','patient-info','states','patient-requests-completed','nghlist','slots','previousrecords','patientshistoryview','count'];
		}
		else if (UserrolesModel::getRole() == '') {
			$permissionsArray = [''];
		}
		else {
			$modulePermissions = ModulePermissions::find()->where(['moduleId' =>1,'adminuserId'=> Yii::$app->user->identity->id])->one();
			if($modulePermissions['permissions_all'] == 1)
			{
				$permissionsArray = ['index','create','update','view','delete','states'];
			}
			else {
				if($modulePermissions['permissions_add'] == 1)
				{
					$permissionAdd = ['create','states','index'];
					$permissionsArray = array_merge($permissionsArray,$permissionAdd);
				}
				if($modulePermissions['permissions_edit'] == 1)
				{
					$permissionEdit = ['update','states','index'];
					$permissionsArray = array_merge($permissionsArray,$permissionEdit);
				}
				if($modulePermissions['permissions_delete'] == 1)
				{
					$permissionDelete = ['delete','states','index'];
					$permissionsArray = array_merge($permissionsArray,$permissionDelete);
				}
				if($modulePermissions['permissions_view'] == 1)
				{
					$permissionView = ['index','view','states'];
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
								'index','create','update','view','delete','profileupdate','profileview','patient-requests','reset-password','patient-info','states','patient-requests-completed','nghlist','slots','previousrecords','patientshistoryview','count'
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
        	$model->availableStatus = 'Offline';        	 
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
            /*  for($k=0; $k<count($model->specialities);$k++)
        	 {
        	 	$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities[$k]])->asArray()->one();
        	 	if(!empty($specid))
        	 	{
        	 		$dspeciality = new DoctorsSpecialities();
        	 		$dspeciality->rdoctorId = $model->userId;
        	 		$dspeciality->rspId =$specid['spId'];
        	 		$dspeciality->save();
        	 	}
          	 }    */ 
        	$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities])->one();
        	if(!empty($specid))
        	{
        		$dspeciality = new DoctorsSpecialities();
        		$dspeciality->rdoctorId = $model->userId;
        		$dspeciality->rspId =$specid['spId'];
        		$dspeciality->save();
        	}
        	
        	
        	$ch = curl_init();
        	$message = 'Thank you '.$model->name.' for Registering with CONSULT.XP, we will send your user id, pass word soon.';
        	//$message = "Your OTP is";
        	$URL =  "http://sms.expertbulksms.com/WebServiceSMS.aspx?User=mulugu&passwd=Mulugu@123$&mobilenumber=".$model->doctorMobile."&message=".urlencode($message)."&sid=mulugu&mtype=N";
        	/* echo $URL;
        	 exit(); */
        	curl_setopt($ch, CURLOPT_URL,$URL);
        	
        	 
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        	$server_output = curl_exec ($ch);
        	//print_r(var_dump($server_output));exit();
        	curl_close ($ch);
        	$sendOtpresp = json_decode($server_output, true);
        	
        	
        	
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
        	 /* for($k=0; $k<count($model->specialities);$k++)
        	 {
        	 	$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities[$k]])->asArray()->one();
        	 	print_r($specid);exit();
        	 	if(!empty($specid))
        	 	{
        	 		$dspeciality = new DoctorsSpecialities();
        	 		$dspeciality->rdoctorId = $model->userId;
        	 		$dspeciality->rspId =$specid['spId'];
        	 		$dspeciality->save();
        	 	}        	 	
        	 } */
        	 $specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities])->one();
        	 if(!empty($specid))
        	 {
        	 	$dspeciality = new DoctorsSpecialities();
        	 	$dspeciality->rdoctorId = $model->userId;
        	 	$dspeciality->rspId =$specid['spId'];
        	 	$dspeciality->save();
        	 }
        	// print_r($specid);exit();
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
    		//echo 'hello';exit();
    		//$model = $this->findModel($id)->delete();
    		$UserInfo = User::find()->where(['id' => $id])->one();
    		$UserInfo->status = 0;
    		$UserInfo->update();
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
    	$firstary = array();
    	$secondary = array();
    	foreach ($model->slotsInfo as $slot)
    	{
    		//print_r($firstary);exit();
    		$firstary[] = $slot['docslotId'];
    	}
    	//print_r($firstary);exit();
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
    					$secondary[] = $slotId;
    					$updateSlotInfo = DoctorSlots::find()->where(['docslotId' => $slotId])->one();
    					if(!empty($updateSlotInfo)){
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
    				else{
    				$slotInfoModel = new DoctorSlots();
    				$slotInfoModel->day = $model->slotsInfo[$k]['day'];
    				$slotInfoModel->startTime = $model->slotsInfo[$k]['startTime'];
    				$slotInfoModel->endTime = $model->slotsInfo[$k]['endTime'];
    				$slotInfoModel->dsDoctorId =  Yii::$app->user->identity->id;
    				$slotInfoModel->save();
    				}
    			}
    			$delary = array_diff($firstary,$secondary);
    			if(!empty($delary))
    			{
    				$rearray = array_values($delary);
    				for($i=0; $i<count($rearray);$i++){
    					$delmodel = $this->findslotsModel($rearray[$i])->delete();
    					//DoctorSlots::delete('docslotId = 1');
    				}
    				//print_r($rearray);exit();
    				//$model = $this->findModel($id)->delete();
    				//DoctorSlots::deleteAll()->where(['IN','docslotId',[$delid]]);
    				//echo 'hello';exit();
    				/* foreach ($delary as $soltdl)
    				{
    					print_r($soltdl);exit();
    				} */
    			}
    			//print_r($delary);exit();
    			Yii::$app->getSession()->setFlash('success', 'Updated New  time slots.');
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
    protected function findslotsModel($id)
    {
    	if (($model = DoctorSlots::findOne($id)) !== null) {
    		return $model;
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
    			/* for($k=0; $k<count($model->specialities);$k++)
    			{
    				$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities[$k]])->asArray()->one();
    				if(!empty($specid))
    				{
    					$dspeciality = new DoctorsSpecialities();
    					$dspeciality->rdoctorId = $model->userId;
    					$dspeciality->rspId =$specid['spId'];
    					$dspeciality->save();
    				}    				 
    			} */
    			$specid = Specialities::find()->select('spId')->where(['specialityName' =>$model->specialities])->asArray()->one();
    			if(!empty($specid))
    			{
    				$dspeciality = new DoctorsSpecialities();
    				$dspeciality->rdoctorId = $model->userId;
    				$dspeciality->rspId =$specid['spId'];
    				$dspeciality->save();
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
    		$docinfo = User::find()->where(['id' => $id])->one();
    		$username = $docinfo->username;
    		$uemail = $docinfo->email;
    		$newpassword = $model->password;
    		$doctorInfo = Doctors::find()->where(['userId' => $id])->one();
    		$name=$doctorInfo->name;
    		//$body='Username:'.$username. + ''.'NewPassword:' .$newpassword;
    		//print_r($username);
    		//print_r($newpassword);exit();    		
    		$body='Hi &nbsp;&nbsp;';
    		$body.=$name;    		
    		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    				Your UserName is:'.$username;
    		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your NewPassword is:' .$newpassword;    				
    		$body.='<br><br><br><u>Thanks&Regards,</u>';
    		$body.='<br>&nbsp;NGH Admin.';
    		\Yii::$app->mailer->compose()
    		->setFrom('ngh@expertwebworx.in')
    		->setTo($uemail)
    		->setSubject('You Have Received a New Message on ' . \Yii::$app->name)
    		->setHtmlBody($body)
    		->send();    		
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
    	$serachparam = Yii::$app->request->queryParams;
    	$serachparam['DoctorNghPatientSearch']['status'] ='PROCESSING';
    	$dataProvider = $searchModel->search($serachparam);    	
    	return $this->render('patientRequests', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);    	
    	//print_r($patientinfoModel);exit();
    }
    public function actionPatientRequestsCompleted()
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
    	$serachparam = Yii::$app->request->queryParams;
    	$serachparam['DoctorNghPatientSearch']['status'] ='COMPLETED';
    	//print_r(Yii::$app->request->queryParams);exit();
    	$dataProvider = $searchModel->search($serachparam);    	 
    	return $this->render('patientRequests', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);    	 
    	//print_r($patientinfoModel);exit();
    }
    public function actionPatientConsultantReport($id)
    {    	
    	 $search = new DoctorNghPatientSearch();
    	 $serachparam = Yii::$app->request->queryParams;
    	//print_r($serachparam);exit();
    	 $serachparam['DoctorNghPatientSearch']['status'] ='COMPLETED';
    	// print_r($serachparam);exit();
    	 $dataProvider=$search->doctorreports($serachparam,$id);    	
    	// $dataProvider = $searchModel->search($data);    	
    	 return $this->render('patientConsultantReport', [    	 
    	 'search' => $search,
    	 'dataProvider' => $dataProvider,
    	 ]); 
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
    		$docnewInfo = Doctors::find()->where(['userId' => $model->doctorId])->one();
    		$nurseInfo = Nursinghomes::find()->where(['nuserId' => $model->nugrsingId])->one();
    		$model->patientRequestStatus = 'COMPLETED';
    		$model->updatedDate = date("Y-m-d H:i:s");
    		$model->update();
    		
    		$ch = curl_init();
    		$message = 'Hello '.$nurseInfo->nursingHomeName.', '.$mpatientModel->firstName.' '.$mpatientModel->lastName.' Advice form is ready to download.';
    				//$mb = '9951904473';
    				//$message = "Your OTP is";
    				$URL =  "http://sms.expertbulksms.com/WebServiceSMS.aspx?User=mulugu&passwd=Mulugu@123$&mobilenumber=".$nurseInfo->mobile."&message=".urlencode($message)."&sid=mulugu&mtype=N";
    				/* echo $URL;
    				 exit(); */
    				curl_setopt($ch, CURLOPT_URL,$URL);
    				 
    				
    				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    				$server_output = curl_exec ($ch);
    				//print_r(var_dump($server_output));exit();
    				curl_close ($ch);
    		//$prmodel = new PatientRequests();    		
    			return $this->redirect(['patient-requests']);    		
    		//print_r($nghId);exit();
    	}
    	/* else{
    		print_r($model->errors);exit();
    	} */    	 
    	return $this->render('patientInfo',
    			['model' => $model,
    					'mpatientModel' => $mpatientModel,
    					'mpatientInformationModel' => $mpatientInformationModel]);
    	//print_r($avialableDoctors);exit();
    }
    public function actionPatientDetails($phsId)
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
    		$model->patientRequestStatus = 'COMPLETED';
    		$model->updatedDate = date("Y-m-d H:i:s");
    		$model->update();    
    		//$prmodel = new PatientRequests();    
    		return $this->redirect(['patient-requests']);    
    		//print_r($nghId);exit();
    	}
    	/* else{
    	 print_r($model->errors);exit();
    	 } */    
    	return $this->render('patientDetails',
    			['model' => $model,
    					'mpatientModel' => $mpatientModel,
    					'mpatientInformationModel' => $mpatientInformationModel]);
    			//print_r($avialableDoctors);exit();
    }
    public function actionNghlist()
    {
    	/*
    	 $searchModel = new NursinghomesSearch();
    	 $dataProvider = $searchModel->search(Yii::$app->request->queryParams);    
    	 return $this->render('nghlist', [
    	 'searchModel' => $searchModel,
    	 'dataProvider' => $dataProvider,
    	 ]); */
    	//$this->layout= '@app/views/layouts/innerpagemain';
    	//$query = Nursinghomes::find();
    	//print_r($query);exit();
    	$dataProvider = new ActiveDataProvider([
    			'pagination' =>  [
    					'pageSize' => 100,
    			],
    			'query' => Nursinghomes::find(),
    	]);    	 
    	return $this->render ('nghlist', [
    			'dataProvider' => $dataProvider,
    	]);    	 
    }
    public function actionNghdetail($nuid)
    {    	 
    	$nusermodel =  User::findOne($nuid);
    	//print_r($nusermodel);exit();
    	$model = Nursinghomes::find()->where(['nuserId' =>$nusermodel->id])->one();    	 
    	return $this->render('nghdetail', [
    			'model' => $model,
    			// 'model' => $model,
    	]);    	 
    }    
    public function actionPreviousrecords($pid)
    {  
    	$searchModel= new PatientsSearch();
    	$serachparam = Yii::$app->request->queryParams;
    	//print_r($serachparam);exit();
    	$dataProvider=$searchModel->previousrecords($serachparam,$pid);
    	return $this->render('previousrecords',[
    			'searchModel'=>$searchModel,
    			'dataProvider'=>$dataProvider
    	]);
    	/*$model = PatientInformation::find()->select(['patientInfoId','createdDate'])->where(['patientId' =>$pid])->orderBy('createdDate DESC')->all();
    	//print_r($model);exit();
    	return $this->render('previousrecords', [
    			'model'=>$model
    	]);*/
    }
public function actionPatientshistoryview($infoid)
    {
    	$model = $this->findinfoModel($infoid);
    	$patmodel = Patients::find()->where(['patientId' =>$model->patientId])->one();
    	//print_r($model->height);exit();    
    	return $this->render('patientshistoryview', [
    			'model' => $this->findinfoModel($infoid),'patmodel' => $patmodel,'infoid'=>$infoid
    	]);
    }   
    protected function findinfoModel($infoid)
    {
    	if (($model = PatientInformation::findOne($infoid)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }
    public function actionDoctorsConsultantReportExcel($id)
    {
    	$status="COMPLETED";
    	
    	$user=User::find()->select('username')->where(['id'=>$id])->all();
    	//print_r($user);exit();
    	$uname = '';
    	foreach ($user as $u)
    	{
    		$uname=$u->username;
    		//print_r($uname);exit();
    	}
    	$query=DoctorNghPatient::find()->where("doctorId= '$id' AND patientRequestStatus='$status' AND (RequestType != 'Review Consultation')")->all();
    	//print_r($query);exit();
    	$dateary=array();
    	$patary=array();
    	$nurary=array();
    	if(!empty($query))
    	{
    		foreach ($query as $dary)
    		{
    			$dateary[]=$dary->updatedDate;
    			//print_r($dateary);
    			$patary[]=$dary->patientId;
    			$nurary[]=$dary->nugrsingId;
    		}
    	}
    	$pfirstname=array();
    	$plastname=array();
    	for($k=0;$k<count($patary);$k++)
    	{
    		$pat=Patients::find()->select('firstName,lastName')->where(['patientId'=>$patary[$k]])->all();
    		foreach ($pat as $pname)
    		{
    		$pfirstname[]=$pname->firstName;
    		$plastname[]=$pname->lastName;
    		}
    	}
    	$nname=array();
    	for($i=0;$i<count($nurary);$i++)
    	{
    		$nur=Nursinghomes::find()->select('nursingHomeName')->where(['nuserId'=>$nurary[$i]])->all();
    		foreach($nur as $name)
    		{
    			$nname[]=$name->nursingHomeName;    			
    		}
    	}
    
    	//print_r(count($nname));exit();
    	
    	/* echo '
    			<table border="1" width="100%">
        <thead>
            <tr>
    			<th>S.No</th>
    			<th>NursingHomeName</th>
				<th>FirstName</th>
    			<th>LastName</th>    			
				<th>Prescription Date</th>
                            </tr>
        </thead>';
    	for($m=0;$m<count($dateary);$m++)
    	{
    		$sno=$m+1;
    		echo '
                <tr>
    				<td>'.$sno.'</td>
    				<td>'.$nname[$m].'</td>
    				<td>'.$pfirstname[$m].'</td>
    				<td>'.$plastname[$m].'</td>    				
    				<td>'.$dateary[$m].'</td></tr>';
    	}
    	echo '</table>'; */
    	$data = '<table border="1" width="100%">
        <thead>
            <tr>
    			<th>S.No</th>
    			<th>NursingHomeName</th>
				<th>FirstName</th>
    			<th>LastName</th>    			
				<th>Prescription Date</th>
                            </tr>
        </thead>';
    	for($m=0;$m<count($dateary);$m++)
    	{
    		$sno=$m+1;
    		$data.=' <tr>
    				<td>'.$sno.'</td>
    				<td>'.$nname[$m].'</td>
    				<td>'.$pfirstname[$m].'</td>
    				<td>'.$plastname[$m].'</td>    				
    				<td>'.$dateary[$m].'</td></tr>';
    		
    	}
    	$data.='</table>';
    	$filename = 'Data-'.Date('YmdGis-').$uname.'-DoctorsConsultantReport.xlsx';
    	//pathinfo($filename, PATHINFO_EXTENSION);
    	header("Content-Type: application/vnd.ms-excel; charset=UTF-8;");
    	header('Content-Disposition:attachment;filename="'.$filename.'"');
    	echo $data;
    }

    public function actionCount($uid)
    {
    	// 	print_r($uid);exit();
    	$model = new Nursinghomes();
    	
    	$count=array();
    	$nurname=array();
    	$nurcountary=array();
    	if (($model->load ( Yii::$app->request->post () )) && ($model->validate ()))
    	{
    		//print_r($model->treatmentstatus);exit();
    		if($model->treatmentstatus == 'PROCESSING' || $model->treatmentstatus == 'COMPLETED')
    		{
    			
    			$nurId=DoctorNghPatient::find()->select('nugrsingId')->distinct()->where("doctorId ='$uid'  AND (createdDate BETWEEN '$model->fromdate' AND '$model->todate' OR updatedDate BETWEEN '$model->fromdate' AND '$model->todate') AND doctor_ngh_patient.RequestType != 'Review Consultation' AND doctor_ngh_patient.patientRequestStatus = '$model->treatmentstatus'")->all();
    		
    		//print_r($doctorId);    		 
    		foreach ($nurId as $did)
    		{
    			$nurcountary[]=$did->nugrsingId;
    		}
    		//print_r($nurcountary);
    		for($k=0;$k<count($nurcountary);$k++)
    		{
    			$query=DoctorNghPatient::find()->select('nugrsingId')->where("doctorId ='$uid' AND nugrsingId='$nurcountary[$k]' AND (createdDate BETWEEN '$model->fromdate' AND '$model->todate' OR updatedDate BETWEEN '$model->fromdate' AND '$model->todate') AND doctor_ngh_patient.RequestType != 'Review Consultation' AND doctor_ngh_patient.patientRequestStatus = '$model->treatmentstatus' ")->count();
    			if($query !='')
    			{
    				$count[]=$query;
    			}
    			//print_r($query);exit();
    			// $query=DoctorNghPatient::find()->select('doctorId')->asArray()->where(['nugrsingId'=>$uid,['createdDate BETWEEN '$model->fromdate' AND '$model->todate'']])->all();
    			 $nursinghomename=Nursinghomes::find()->select('nursingHomeName')->where(['nuserId'=>$nurcountary[$k]])->all();
    			foreach($nursinghomename as $n)
    			{
    				$nurname[]=$n['nursingHomeName'];
    			}
    			// print_r($nurname);
    		}
    		}
    		else {
    			$nurId=DoctorNghPatient::find()->select('nugrsingId')->distinct()->where("doctorId ='$uid'  AND (createdDate BETWEEN '$model->fromdate' AND '$model->todate' OR updatedDate BETWEEN '$model->fromdate' AND '$model->todate') AND doctor_ngh_patient.RequestType != 'Review Consultation'")->all();
    			
    			//print_r($doctorId);
    			foreach ($nurId as $did)
    			{
    				$nurcountary[]=$did->nugrsingId;
    			}
    			//print_r($nurcountary);
    			for($k=0;$k<count($nurcountary);$k++)
    			{
    				$query=DoctorNghPatient::find()->select('nugrsingId')->where("doctorId ='$uid' AND nugrsingId='$nurcountary[$k]' AND (createdDate BETWEEN '$model->fromdate' AND '$model->todate' OR updatedDate BETWEEN '$model->fromdate' AND '$model->todate') AND doctor_ngh_patient.RequestType != 'Review Consultation'")->count();
    				if($query !='')
    				{
    					$count[]=$query;
    				}
    				//print_r($query);exit();
    				// $query=DoctorNghPatient::find()->select('doctorId')->asArray()->where(['nugrsingId'=>$uid,['createdDate BETWEEN '$model->fromdate' AND '$model->todate'']])->all();
    				$nursinghomename=Nursinghomes::find()->select('nursingHomeName')->where(['nuserId'=>$nurcountary[$k]])->all();
    				foreach($nursinghomename as $n)
    				{
    					$nurname[]=$n['nursingHomeName'];
    				}
    				// print_r($nurname);
    			}
    		}
    	}
    	//exit();
    	return $this->render('count',[
    			'model'=>$model,
    			'count'=>$count,
    			'nurname'=>$nurname,
    			'nurcountary'=>$nurcountary,
    	]);
    }

    
    public function actionPrescriptionpdf()
    {
    	$phsId = 0;
    	
    	if(isset($_GET['phsId']) && $_GET['phsId'] != '')
    	{
    		$phsId = $_GET['phsId'];
    	}
    	if($phsId != 0){

    	$model = DoctorNghPatient::find()->where(['patientHistoryId' => $phsId])->one();
    	
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
    	$doctorInfo = Doctors::find()->select('name,doctorImage')->where(['userId' => $model->doctorId])->one();
    	$nursinghomeinfo = Nursinghomes::find()->where(['nuserId' => $model->nugrsingId])->one();
    	$precriptionDate = date('d-M-Y', strtotime($model->updatedDate));
    	$currentdatenew = date('d-M-Y');
    	if($doctorInfo->doctorImage == NULL || $doctorInfo->doctorImage == '')
    	{
    		$doctorInfo->doctorImage = 'images/user-iconnew.png';
    	}
    	
    	
    	$doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $model->doctorId])->all();
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
    	$docSpecialities = DoctorsSpecialities::find()->select('rspId')->where( ['rdoctorId' => $model->doctorId])->all();
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
    	
    	if(!empty($docqualiary))
    	{
    	
    	$doctorallQualifications = implode(",",$docqualiary);
    	}
    	else{
    		$doctorallQualifications = '';
    	}
    	
    	if(!empty($docspeciary))
    	{
    		 
    		$doctorallSpec = $docspeciary[0];
    	}
    	else{
    		$doctorallSpec = '';
    	}
    	
    	
    	$html = <<<HTML
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Insert Title Here</title>
</head>

<body style="box-sizing:border-box; font-family: 'Source Sans Pro',sans-serif; margin:0px; padding:0px;">
<div style="width:576px;  height:auto; overflow:hidden; margin:10px auto; border:1px solid #bce8f1; border-radius:4px; padding:10px; position:relative;">
  <header style="width:576px; float:left; position: relative; border-bottom: 2px solid #5aab4a; padding: 0 10px; box-sizing: border-box;">
    <h1 style="font-family: 'Source Sans Pro',sans-serif; font-size: 38px; color:#ff6600; text-align:center; margin:0px;">CONSULT XP</h1>
    <h3 style="font-family: 'Source Sans Pro',sans-serif; color: #323232; font-size: 18px; text-align:center; margin:0px;">ADDRESS</h3>
    <h2 style="font-family: 'Source Sans Pro',sans-serif; color: #3572af; font-size:22px; padding: 5px 0; text-align:center; margin:0px;">ADVICE FORM</h2>
    <div style="width:556px; float:left; position: relative;">
      <div style="width:278px; float:left; position:relative;">
        <div style="width: 278px; float: left; position: relative; padding:0 0 10px 0;">
          <label style="width: 139px; float: left; color: #295a8c; font-size: 14px;">DR NAME <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 139px; float: left;">$doctorInfo->name</span> </div>
        <div style="width: 278px; float: left; position: relative; padding:0 0 10px 0;">
          <label style="width: 139px; float: left; color: #295a8c; font-size: 14px;">SPECIALIZATION <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 139px; float: left;">$doctorallSpec</span> </div>
        <div style="width: 278px; float: left; position: relative; padding:0 0 10px 0;">
          <label style="width: 139px; float: left; color: #295a8c; font-size: 14px;">QUALIFICATION <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
          <span style="font-size: 14px; color: #333; max-width: 139px; float: left;">$doctorallQualifications</span> </div>
      </div>
      <div style="width:278px; float:left; position:relative; margin-top:20px;">
        <h3 style="font-size: 15px; color: #333; float: right; padding:12px 0; text-align: right; margin:0px;">Date: <span>$currentdatenew</span></h3>
      </div>
    </div>
  </header>
  <aside style="width:576px; float:left; position: relative; border-bottom: 2px solid #5aab4a; padding:10px; padding-bottom:0px; box-sizing: border-box;">
    <div style="width:270px; float:left; position:relative; padding-right:5px; box-sizing:border-box;">
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">PATIENT NAME <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientModel->firstName $mpatientModel->lastName</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">AGE /SEX <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientModel->age/$mpatientModel->gender</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">COMPLAINTS <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->patientCompliant</span> </div>
        <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">DIAGNOSIS <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->diseases</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">R R <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->respirationRate</span> </div>
      
      
    </div>
    <div style="width:270px; float:left; position:relative; padding-left:5px; box-sizing:border-box;">
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">PATINET UID <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientModel->patientUniqueId</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">BP <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->BPLeftArm</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">TEMP <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->temparatureType</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">SPO<sub>2</sub> <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->spo2</span> </div>
      <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">PRATE <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->pulseRate</span> </div>
        
        <div style="width: 270px; float: left; position: relative; padding:0 0 10px 0;">
        <label style="width: 130px; float: left; color: #295a8c; font-size: 14px;">WGT <i style="font-style: normal; float: right; padding-right: 15px;">:</i></label>
        <span style="font-size: 14px; color: #333; max-width: 130px; float: left;">$mpatientInformationModel->weight</span> </div>
      
    </div>
    <div style="width:556px; float:left; position:relative;">
      <h6 style="color:#3572af; font-weight:600; font-size:14px; text-align:center; margin:0px; padding:10px;">ADVICE</h6>
      <div style="height:200px; width:100%; float:left; position:relative; font-size:14px; margin:0 0 10px 0; padding:10px; box-sizing:border-box; border:1px solid #999; border-radius:5px;"> $model->treatment </div>
    </div>
    
<div style="width:556px; float:left; position:relative;">
          <h6 style="color:#3572af; font-weight:600; font-size:14px; text-align:left; margin:0px; padding:10px;">Disclaimer</h6>
          <ul>
  <li> This tele consultation is provided on the request of the remote medical centre. As there is no availability of similar expertise at that place.</li>
  <li> This expert consultation is provided basing on the clinical data provided by remote medical centre.</li>
  <li>However if there is no improvement in the patient condition the patient may be referred to a higher centre for further management.</li>
<li>The remote medical centre is advised to take the decision on the patient's treatment and not rely completely on tele consultation due to its limitations. </li>
</ul>
      </div>
    
  </aside>
  <footer style="width:556px; float:left; position: relative; padding:10px; padding-bottom:0px; box-sizing: border-box;">
    <div style="width: 556px; float: left; position: relative; padding:0px; font-family: 'Source Sans Pro',sans-serif; font-size: 13px; color: #989898; text-align:center;"> $nursinghomeinfo->nursingHomeName - $nursinghomeinfo->mobile </div>
  </footer>
</div>
</body>
</html>
    	
    	
    	
    	
   
HTML;
    	
    	
    	$pdf = Yii::$app->pdf;
$pdf->content = $html;
$pdf->filename = 'Doctor Prescription';
return $pdf->render();
    	}

}

}
