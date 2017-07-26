
<?php
use yii\helpers\Html;
use common\models\User;
use app\models\DoctorsSpecialities;
use yii\widgets\ListView;

$this->title = ' Doctors List';

?>
<?php 
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">
	
<style>
th {
	display: none;
}
</style>
	                   <?=  ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemView' => 'specialiti_based_doctor_list_view',
                               ]); ?>
</div>
</div>
</div>

                                  
							
																 							
						







