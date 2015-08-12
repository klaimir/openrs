<?php 
if (isset($message))
{
    if($message!="")
    {
        if(!isset($color_message)) { $color_message='danger'; }
?>
    <div class="alert alert-<?php echo ($color_message); ?>">
        <button class="close" data-dismiss="alert" type="button">
        <i class="ace-icon fa fa-times"></i>
    </button>
        <strong> <i class="icon-remove"></i> - Atenci&oacute;n -</strong>
        <?php echo $message; ?>
    </div>
<?php
    }
}