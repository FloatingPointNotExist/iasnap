<?php
if ($scenario=="view") echo CHtml::label($modelff->getAttribute(strtolower($data->name)),"") ;
else {
    $baseUrl = Yii::app()->baseUrl;
    $cs = Yii::app()->getClientScript();
    $cs->registerScriptFile($baseUrl.'/ckeditor/ckeditor.js');
    $namefield=get_class($modelff)."_".$data->name;
    echo $form->textArea($modelff,$data->name,array("style"=>"width:100%")) ?>
    <script type="text/javascript">
       var editor=CKEDITOR.instances.<?=$namefield?>;
       if (!editor) { 
           CKEDITOR.replace('<?= $namefield ?>');
       }       
    </script>
<?php } ?>