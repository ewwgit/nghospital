<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\doctors\models\DoctorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nursing Homes List';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary">
<div class="box-body">
<div class="row">

<div class="col-md-12" >
  
 
  	<?php  echo ListView::widget( [
					'dataProvider' => $dataProvider,
					'itemView' => 'nghview',
					'viewParams' => [],
					'pager' => [
							 
							'prevPageLabel' => 'PREV',
							'nextPageLabel' => 'NEXT',
							'maxButtonCount' => 5,
							 
					],
					'layout' => "{items}\n{pager}",
			] );
		?>
		
 
</div>
</div>
</div>
</div>
<style>
th{
display:none;
}

</style>


