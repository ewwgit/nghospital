<?php
namespace app\modules\nursinghomes\controllers;

use Yii;
use app\modules\nursinghomes\models\Nursinghomes;
use app\modules\nursinghomes\models\NursinghomesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Countries;
use app\models\States;

use common\models\User;
use yii\helpers\Json;
use backend\models\SignupForm;
use app\models\UserMain;
use yii\web\UploadedFile;
use backend\models\ChangePasswordForm;

use app\models\UserrolesModel;
use yii\filters\AccessControl;
use app\models\ModulePermissions;

use yii\data\ActiveDataProvider;
use app\modules\specialities\models\Specialities;
//use app\models\DoctorsSpecialities;
use app\modules\doctors\models\Doctors;
use app\modules\doctors\models\DoctorsQualification;
use app\modules\qualifications\models\Qualifications;
use app\modules\doctors\models\DoctorsSpecialities;
use app\modules\patients\models\DoctorNghPatient;
use app\modules\patients\models\Patients;
use app\modules\patients\models\DoctorNghPatientSearch;


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
	
		$permissionsArray = [''];
		if(UserrolesModel::getRole() == 1)
		{
			$permissionsArray = ['index','create','update','view','delete','states','reset-password'];
		}
		else if(UserrolesModel::getRole() == 3)
		{
			$permissionsArray = ['profileupdate','profileview','reset-password','states','doctorspecialitieslist','specialitibaseddoctorlist'];
		}else if (UserrolesModel::getRole() == '') {
			$permissionsArray = [''];
		}
		else {
			$modulePermissions = ModulePermissions::find()->where(['moduleId' =>3,'adminuserId'=> Yii::$app->user->identity->id])->one();
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
								'index','create','update','view','delete','profileupdate','profileview','reset-password','states','doctorspecialitieslist','specialitibaseddoctorlist'
	
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
     * Lists all Nursinghomes models.
     * @return mixed
     */
    public function actionIndex()
    {
    	
        $searchModel = new NursinghomesSearch();
//         $params = Yii::$app->request->queryParams;
//         $params['role'] = 3;
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
        $singupModel = new SignupForm();
        $model->scenario = 'create';
       // print_r( Yii::$app->user->identity->id);exit;
               
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
        	$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
        	if($model->validate())
        	
        
        	{
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
        	//echo $uniqonlyId.'NGH'.$dayval.$monthval.$dateInfo['year'];exit();
        	$singupModel->username = $model->username;
        	$singupModel->email = $model->email;
        	$singupModel->password = $model->password;
        	$singupModel->role = 3;
        	$user = $singupModel->signup();
        	$model->email = 'dummy@mailinator.com';
        	$model->username = 'dummy';
//         	print_r($model->country);
//         	print_r($model->state);exit;
            $model->createdDate = date('Y-m-d H:i:s');
            $model->updatedDate = date('Y-m-d H:i:s');
        	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
            $model->nuserId = $user->id;
        	//$model->createdBy = 1;
        	
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy = Yii::$app->user->identity->id;        	
        	$model->nurshingUniqueId = $overallUniqueId;
        	if(!(empty($model->nursingImage)))
        	{
        		 
        		$imageName = time().$model->nursingImage->name;
        		 
        		$model->nursingImage->saveAs('profileimages/'.$imageName );
        		 
        		$model->nursingImage = 'profileimages/'.$imageName;
        	}
        	$model->save();
        	//print_r($model);exit;
        	
          // return $this->redirect(['view', 'id' => $model->nuserId]);
        	Yii::$app->session->setFlash('success', " Nursing Homes Created successfully ");
           return $this->redirect(['index']);
                 
        }  else {
            return $this->render('create', [
                'model' => $model,
            	
                
            ]);
        }
       
        }
        else {
            return $this->render('create', [
                'model' => $model,
            	
                
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
        $singupModel = new SignupForm();
        $model->scenario = 'update';
   
        $model->countriesList = Countries::getCountries();
        $model->citiesData = [];
        $model->nursingimageupdate = $model->nursingImage;
        $model->nursingImage = '';
        
    //  print_r($model->country);exit;
        
      
     if($model->country != ''){
        
        	$model->statesData= Countries::getStatesByCountryupdate($model->country );
        
        }else{
        	$model->country = $model->country;
        	
        	$model->statesData =[];
        	$model->state='';
        }
   
    
       $usermodel = User::find() ->where(['id' =>$model->nuserId])->one();
        if (! (empty ( $usermodel ))) {
            $model->username = $usermodel->username;
        	$model->email = $usermodel->email;
        	$model->status = $usermodel->status;
        	}
        	        	
        if (($model->load ( Yii::$app->request->post () )) && ($model->validate ())) {
        	
        	$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
          	$model->countryName = Countries::getCountryName($model->country);
        	$model->stateName = States::getStateName($model->state);
        	$model->updatedDate = date('Y-m-d H:i:s');
            $model->updatedBy = Yii::$app->user->identity->id;
        	$usermodel->status = $model->status;
        	$usermodel->save();
        	if(!(empty($model->nursingImage)))
        	{
        		 
        		$imageName = time().$model->nursingImage->name;
        		 
        		$model->nursingImage->saveAs('profileimages/'.$imageName );
        	
        		$model->nursingImage = 'profileimages/'.$imageName;
        		 
        	}
        	else {
        		$model->nursingImage = $model->nursingimageupdate;
        	}
            $model->save();
          	        
           // return $this->redirect(['view', 'id' => $model->nursingId]);
            Yii::$app->session->setFlash('success', " Nursing Homes Updated successfully ");
          	  return $this->redirect(['index']);
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
    	
    	try{
    		//$model = $this->findModel($id)->delete();
    		$UserInfo = User::find()->where(['id' => $id])->one();
    		$UserInfo->status = 0;
    		$UserInfo->update();
    		Yii::$app->getSession()->setFlash('success', 'You are successfully deleted  Nursing Home.');
    	
    	}
    	 
    	catch(\yii\db\Exception $e){
    		Yii::$app->getSession()->setFlash('error', 'This Nursing Home is not deleted.');
    	
    	}
     //   $this->findModel($id)->delete();

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
    	$model = Nursinghomes::find()->where(['nuserId' =>$usermodel->id])->one();
    	//print_r($model);exit();
    	$singupModel = new SignupForm();
    	$model->scenario = 'update';
    	 
    	$model->countriesList = Countries::getCountries();
    	$model->citiesData = [];
    	$model->nursingimageupdate = $model->nursingImage;
    	$model->nursingImage = '';
    
    	//  print_r($model->country);exit;
    
    
    	if($model->country != ''){
    
    		$model->statesData= Countries::getStatesByCountryupdate($model->country );
    
    	}else{
    		$model->country = $model->country;
    		 
    		$model->statesData =[];
    		$model->state='';
    	}
    	 
    
    	$usermodel = User::find() ->where(['id' =>$model->nuserId])->one();
    	if (! (empty ( $usermodel ))) {
    		$model->username = $usermodel->username;
    		$model->email = $usermodel->email;
    		$model->status = $usermodel->status;
    	}
    
    	if (($model->load ( Yii::$app->request->post () )) && ($model->validate ())) {
    		 
    		$model->nursingImage = UploadedFile::getInstance($model,'nursingImage');
    		$model->countryName = Countries::getCountryName($model->country);
    		$model->stateName = States::getStateName($model->state);
    		$model->updatedDate = date('Y-m-d H:i:s');
    		$model->updatedBy = Yii::$app->user->identity->id;
    		$usermodel->status = $model->status;
    		$usermodel->save();
    		if(!(empty($model->nursingImage)))
    		{
    			 
    			$imageName = time().$model->nursingImage->name;
    			 
    			$model->nursingImage->saveAs('profileimages/'.$imageName );
    			 
    			$model->nursingImage = 'profileimages/'.$imageName;
    			 
    		}
    		else {
    			$model->nursingImage = $model->nursingimageupdate;
    		}
    		$model->save();
    		 
    		// return $this->redirect(['view', 'id' => $model->nursingId]);
    		Yii::$app->session->setFlash('success', " Nursing Homes Updated successfully ");
    		return $this->redirect(['profileview','uid' => $usermodel->id]);
    		
    	} else {
    		return $this->render('profileupdate', [
    				'model' => $model,
    				 
    		]);
    	}
    }
    public function actionProfileview($uid)
    {
    	$usermodel = $this->finduserModel($uid);
    	$model = Nursinghomes::find()->where(['nuserId' =>$usermodel->id])->one();
    	if (!$model) {
    		throw new NotFoundHttpException('model not found');
    	}
    	return $this->render('profileview', [
    			'model' => $model,
    			// 'model' => $model,
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
    		$nurseinfo = User::find()->where(['id' => $id])->one();
    		$username = $nurseinfo->username;
    		$uemail = $nurseinfo->email;
    		$newpassword = $model->password;
    		$nurseingInfo = NursingHomes::find()->where(['nuserId' => $id])->one();
    		$name=$nurseingInfo->nursingHomeName;
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
    public function actionDoctorspecialitieslist()
    {
    	//$query = new Query();
    	$dataProvider = new ActiveDataProvider([
    			'query' => Specialities::find()->where(['status' => 'Active']),
    			'pagination' => [
    					'pageSize' => 10,
    			],
    	]);
    	 
    	$this->view->title = 'Specialities List';
    
    	return $this->render('doctors_specialities_list', [
    			'dataProvider' => $dataProvider,
    			 
    
    	]);
    
    }
    public function actionSpecialitibaseddoctorlist($id)
    {
    	$model = new DoctorsSpecialities();
       	$dataProvider = new ActiveDataProvider([
    			'query' => DoctorsSpecialities::find()->where(['rspId' => $id]),
    			'pagination' => [
    					'pageSize' => 10,
    			],
    	]);
    
    	return $this->render('sp_based_doc_list', [
    		'dataProvider' => $dataProvider,
    			    			 
    	]);
    }
    public function actionDoctorview($id)
    {
    	$model = new Doctors();
    	    	
    	$doctordata = Doctors::find()->select(['userId','name','doctorUniqueId','doctorMobile','city','state','stateName','country','countryName','address','permanentAddress','pinCode','doctorImage','summery','availableStatus','TSMC','APMC'])->where(['userId'=>$id])->one();
        $doctorQulification = DoctorsQualification::find()->select('qualification')->where( ['docId' => $doctordata->userId])->all();
    	
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
     	
     	$docSpecialities = DoctorsSpecialities::find()->select('rspId')->where( ['rdoctorId' => $doctordata->userId])->all();
     	$dsary = array();
     	$docspeciary = array();
     	if(!empty($docSpecialities))
     	{
     		foreach ($docSpecialities as $ds)
     		{
     			$dsary[] = $ds->rspId;
     			 
     		}
     	}
     	 for($m=0; $m<count($dsary); $m++)
     	{
     		$docspeci = Specialities::find()->select('specialityName')->where( ['spId' => $dsary[$m]])->asArray()->one();
     		$docspeciary[] = $docspeci['specialityName'];
     	}
    	//print_r($docqualiary);
    	
    	return $this->render('doctor_view', [
    			'model' => $model,
    			
    			'doctordata' => $doctordata,
    			'docqualiary' =>$docqualiary,
    			'docspeciary'=>$docspeciary,
    			
    	]);
    }
    public function actionDoctorreport()
    {
    	
    	$nursId = Yii::$app->user->identity->id;
    	$status= "COMPLETED";
    	$doctormodel = DoctorNghPatient::find()-> where(['nugrsingId'=> $nursId ,'patientRequestStatus'=>$status])->all();
    	$drary = array();
    	$patary = array();
    	if(!empty($doctormodel))
    	{
    		foreach ($doctormodel as $dr)
    		{
    			$drary[] = $dr->patientId;
    			//print_r($drary);exit();
    			 
    		}
    	}
    	for($k=0; $k<count($drary); $k++)
    	{
    		$pat = Patients::find()->select('firstName')->where(['patientId'=>$drary[$k]])->asArray()->one();
    		$patary[] = $pat['firstName'];
    	}
    	$ddary=array();
    	$docary = array();
    	if(!empty($doctormodel))
    	{
    		foreach ($doctormodel as $dd)
    		{
    			$ddary[] = $dd->doctorId;
    			//print_r($ddary);exit();
    	
    		}
    	}
    	for($m=0; $m<count($ddary); $m++)
    	{
    		$doc = Doctors::find()->select('name')->where(['userId'=>$ddary[$m]])->asArray()->one();
    		//print_r($doc);exit();
    		$docary[] = $doc['name'];
    	}
    	$cdate = array();
    	if(!empty($doctormodel))
    	{
    		foreach ($doctormodel as $dt)
    		{
    			$cdate[] = $dt->updatedDate;
    			
    			 
    		}
    	}
    	//print_r($cdate);exit();
    
    	return $this->render('doctorReport', [
    			'cdate'=>$cdate,
    			'docary'=> $docary,
    			'patary' => $patary
    	]);
    	
    	  
    	  
    
    }
    

    
    
}
