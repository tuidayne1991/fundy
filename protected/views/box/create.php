<?php
/* @var $this BoxController */
/* @var $model MoneyBox */

$this->breadcrumbs=array(
	'Money Boxes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MoneyBox', 'url'=>array('index')),
	array('label'=>'Manage MoneyBox', 'url'=>array('admin')),
);
?>

<h1>Create MoneyBox</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>