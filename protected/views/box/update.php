<?php
/* @var $this BoxController */
/* @var $model MoneyBox */

$this->breadcrumbs=array(
	'Money Boxes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MoneyBox', 'url'=>array('index')),
	array('label'=>'Create MoneyBox', 'url'=>array('create')),
	array('label'=>'View MoneyBox', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MoneyBox', 'url'=>array('admin')),
);
?>

<h1>Update MoneyBox <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>