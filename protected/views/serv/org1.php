<?php
/* @var $this ServController */


$this->widget('zii.widgets.CMenu', array( 'encodeLabel'=>false, 'items' => GenServCategories::model()->getOrgMenu1()));

?>