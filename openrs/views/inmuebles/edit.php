<?php menu_inmuebles ($element->id,"inmuebles"); ?>

<div class="page-header">
    <h1>
        Datos del inmueble
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo lang('common_btn_edit'); ?>
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_demandantes" data-toggle="tab">DEMANDANTES</a></li>
        <li><a href="#tab_propietarios" data-toggle="tab">PROPIETARIOS</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_demandantes">
            <?php $this->load->view('inmuebles/list_demandantes', $this->data); ?>
        </div>
        <div class="tab-pane" id="tab_propietarios">
            <?php $this->load->view('inmuebles/list_propietarios', $this->data); ?>
        </div>
    </div>    
</div>

<?php $this->load->view($_view.'/form', $this->data); ?>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            <?php echo lang('common_btn_edit'); ?>
        </button>
    </div>
</div>

<?php echo form_hidden('id',$element->id); ?>

<?php echo form_close(); ?>

<script type="text/javascript">
    jQuery(function($) {
       show_submenu();
    })
</script>