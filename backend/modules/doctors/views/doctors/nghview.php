<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\web\View;
$url = Yii::$app->urlManager->createUrl(['doctors/doctors/nghdetail','nuid'=>$model['nuserId']]);
$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;
//Yii::$app->urlManager->createUrl(['employees?EmployeeJobsearch%5Bcompany_name%5D='.$model['company_name']]);
/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Nursing Homes List';
//$this->params['breadcrumbs'][] = $this->title;




?>


<div class="form-group col-lg-3 col-sm-12">

<ul class="list-group">
  <li class="list-group-item">
   
   	  <div style="text-align:center;"><img 
							src="<?php
							if($model->nursingImage)
							{
								
								echo isset( $model->nursingImage)? Url::base().'/'.$model->nursingImage : '' ;
							
							}else {
									 echo Url::base()."/images/user-iconnew.png" ;
								      }
								?>"
							style="height:150px;width:150px;"> </img> </div>
							<div class="ngh">
  
  	<div class=" color ">Nursing Home </div>	
  	<div class="col  " >:</div>							
    <div class=" val ">
    <?php if(! empty ($model->nursingHomeName))
    {
    	echo $model->nursingHomeName;
    }
    else
    {
    	echo "Not Mentioned";
    }
    		?> </div>
    	<div class=" color ">Contact Person </div>	
  	<div class="col  " >:</div>							
    <div class=" val ">
    <?php if(!empty($model->contactPerson))
    {
    	echo $model->contactPerson;
    }
    else
    {
    	echo "Not Mentioned";
    }
    	?> </div>
 
  
    
  	</div>
 
</li>
</ul>


</div>
<style>
.col{
color: #3c8dbc;
margin-left: 110px;;
margin-top: -19px;
}
.color{
color: #3c8dbc;
margin-top: 10px;
padding-left:20px;
}
.val{
margin-left: 120px;
margin-top: -18px;

}
.ngh
{
min-height:120px;
}
</style>


		
   

