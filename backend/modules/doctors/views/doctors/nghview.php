<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\DetailView;

$url = Yii::$app->urlManager->createUrl(['doctors/doctors/nghdetail','nuid'=>$model['nuserId']]);
$imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->nursingImage;

?>
<div class="col-sm-3">
<ul class="list-group">
  <li class="list-group-item">
    <div ><?php echo  Html::img($imgeurl ,['width' => '200px','height' => '150px'],['doctors/nghdetail','nuid'=>$model->nuserId]); ?> </div>
  	<div class=" color ">Nursing Home </div>	
  	<div class="col  " >:</div>							
    <div class=" val "><?php echo $model->nursingHomeName; ?> </div>
    <div class=" color ">Contact Person </div>	
  	<div class="col  " >:</div>							
    <div class=" val "><?php echo $model->contactPerson; ?> </div>
 </li>
</ul>
</div>
<style>
.col{
color: #3c8dbc;
margin-left: 95px;;
margin-top: -19px;
}
.color{
color: #3c8dbc;
margin-top: 10px;
}
.val{
margin-left: 110px;
margin-top: -18px;

}
li{
list-style-type:none;
margin-bottom:20px;
margin-top:20px;

}
</style>


		
   

