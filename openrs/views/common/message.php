<?php
if ($this->session->flashdata('message') != "") { $message = $this->session->flashdata('message'); }
if ($this->session->flashdata('message_color') != "") { $message_color = $this->session->flashdata('message_color'); }

if (isset($message) && $message!="")
{
    if(!isset($message_color)) { $message_color='danger'; }
?>
    <div class="alert alert-<?php echo ($message_color); ?>">
        <button class="close" data-dismiss="alert" type="button">
        <i class="ace-icon fa fa-times"></i>
    </button>
        <strong> <i class="icon-remove"></i> - Atenci&oacute;n -</strong>
        <?php echo $message; ?>
    </div>
<?php
}