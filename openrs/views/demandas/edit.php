<?php menu_demandas ($element->id,"demandas"); ?>

<div class="page-header">
    <h1>
        Datos de la demanda <?php echo $element->referencia; ?>
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            <?php echo lang('common_btn_edit'); ?>
            <?php 
            // Imprimimos última fecha de actualización
            if(!is_null($element->fecha_actualizacion))
            {
                echo " (<strong>Última vez actualizado: ".$this->utilities->cambiafecha_bd($element->fecha_actualizacion)."</strong>)"; 
            }
            ?>
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_inmuebles_propuestos" data-toggle="tab">INMUEBLES PROPUESTOS</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_inmuebles_propuestos">
            <?php $this->load->view('demandas/list_inmuebles_propuestos', $this->data); ?>
        </div>
    </div>    
</div>

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

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