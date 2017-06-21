<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
//**********************//
use common\models\User;
//**********************//

/* @var $this yii\web\View */
/* @var $model app\modules\doctors\models\Doctors */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Doctors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doctors-view">
<p>
        <?= Html::a('Update', ['update', 'id' => $model->doctorid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->doctorid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="container">
    <div class="row">      
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" style="margin-left:0px; padding-left: 0px;">			   
			<div class="panel panel-info">		
					<div class="col-md-6">	
						<div class="box3">
						<h4>Doctor Name: <?= $model->name; ?></h4>
						<h4>Unique ID : <?= $model->doctorUniqueId; ?></h4>
						</div>				
					</div>
					<div class="col-md-3">
					<?php 
					$usernamedata = User::find()->select(['username','email'])->where(['id'=>$model->userId])->one();
					// print_r($usernamedata);exit;?>
					<?php if($model->doctorImage != ''){?>
					<?php $imgeurl = str_replace("frontend","backend",Yii::getAlias('@web/')).$model->doctorImage;?>
					<?php  } ?>
					<?= DetailView::widget([
							'model' => $model,
							'attributes' => [
									[
											'attribute'=>'doctorImage',
											'format' => 'html',
											'value'=>Html::img($model->doctorImage ? $imgeurl : '/@web/images/user-iconnew.png',['width' => '150px','height' => '150px']),
        		],
        ],
    ]) ?>
					</div>			
          
				<div class="panel-body">		   
					<!--form section start -->
	
					<div class="row">
						<div class="col-md-12 col-sm-6 col-xs-6 main-wrap">
							<div class="doctor-box">					        
								<div class="right">Username</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['username']; ?> </div>
								
								<div class="right">Email</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $usernamedata['email']; ?> </div>
								
								<div class="right">Qualification</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= 'qualification'; ?></div>
								
								<div class="right">Country Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->countryName; ?> </div>
								
								<div class="right">City</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->countryName; ?></div>
								
								<div class="right">State Name</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->stateName; ?> </div>
								
								<div class="right">Present Address</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->address; ?> </div>
								
								<div class="right">Permanent Adress</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->permanentAddress; ?></div>
								
								<div class="right">Pin Code</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->pinCode; ?> </div>
								
								<div class="right">Mobile</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->doctorMobile; ?></div>
								
								<div class="right">Summery</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->summery; ?></div>

								
								<div class="right">APMC</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->APMC; ?> </div>
								
								<div class="right">TSMC</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->TSMC; ?> </div>
								
								<div class="right">Created By</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->createdBy; ?> </div>
								
								<div class="right">Updatd By</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->updatedBy; ?> </div>
								
								<div class="right">Created Date</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->createdDate; ?> </div>
								
								<div class="right">Updated Date</div>								
								<div class="right-content">:</div>
								<div class="right-second"><?= $model->updatedDate; ?> </div>								 							
							</div><!---doctor-box closed-->							
						</div>	<!---main-wrap closed-->							
					</div><!---row closed-->						
				</div><!---panel-body closed-->		
			</div><!---panel-info closed-->	
		</div><!---toppad-->
	</div><!--row closed-->	
</div>
</div>


