<?php
/* @var $this BoxController */
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

<button class="btn btn-primary" id="js-add-box">+</button>
<div id="box-form-container">
</div>

<?php
$add_box_form_script = <<<EO_SCRIPT
$(document).on('click', '#js-add-box', function(event){
    event.preventDefault();
    var container = $('#box-form-container');
    var url = '/box/loadForm';
    var json = { };
    $.post(url,json, function(data) {
        if(data){
            container.html(data);
            container.show();
        }
    });
});
EO_SCRIPT;
Yii::app()->clientScript->registerScript('add_box_form', $add_box_form_script, CClientScript::POS_READY);
?>