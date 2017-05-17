<div class="page-header">
    <h1>
        Tipos de ficheros adjuntos
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo lang('common_btn_edit'); ?>
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<?php $this->load->view($_view.'/form', $this->data); ?>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo lang('common_btn_edit'); ?>
        </button>
        <button class="btn" type="reset">
            <i class="ace-icon fa fa-undo bigger-110"></i>
            Reset
        </button>
    </div>
</div>

<?php echo form_hidden('id',$element->id); ?>

<?php echo form_close(); ?>
