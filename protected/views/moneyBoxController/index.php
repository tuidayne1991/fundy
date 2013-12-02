<?php
/* @var $this MoneyBoxControllerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Money Boxes',
);

$this->menu=array(
	array('label'=>'Create MoneyBox', 'url'=>array('create')),
	array('label'=>'Manage MoneyBox', 'url'=>array('admin')),
);
?>

<h1>Money Boxes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
