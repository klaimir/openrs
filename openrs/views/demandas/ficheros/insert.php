<?php menu_demandas ($demanda->id,"demandas_ficheros"); ?>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Ficheros de la demanda <?php echo $demanda->referencia; ?>
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Subir
                </small>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>

        <?php $this->load->view($_view.'/form', $this->data); ?>

        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="submit" value="upload">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    <?php echo lang('common_btn_insert'); ?>
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>
    </div>
</div>

<?php echo form_close(); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {        
       show_submenu();
    })
</script>