<?php
/* @var $this BoxController */
/* @var $model MoneyBox */

$this->breadcrumbs=array(
	'Money Boxes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MoneyBox', 'url'=>array('index')),
	array('label'=>'Create MoneyBox', 'url'=>array('create')),
	array('label'=>'Update MoneyBox', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MoneyBox', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MoneyBox', 'url'=>array('admin')),
);
?>

<h1>View MoneyBox #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'owner_id',
		'balance',
		'capacity',
		'currency',
	),
)); ?>
