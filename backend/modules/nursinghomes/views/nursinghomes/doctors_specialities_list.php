<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\specialities\models;
use yii\widgets\ListView;

?>
<h1 ><?php $this->title = ' Doctors Specialities List';?></h1>
<?php 
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="doctors-view">
<div class="box box-primary">
<div class="box-body">

<style>
th {
	display: none;
}
</style>
    <div class="row">
	<div class="col-md-12 ">
                     <?=   ListView::widget([
                           'dataProvider' => $dataProvider,
                           'itemView' => 'doctor_specialiti_list_view',
                           ]); 
                         ?>
		
   </div>
   </div>
</div>
</div>
</div>







