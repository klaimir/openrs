<?php menu_inmuebles ($inmueble->id,"inmuebles_fichas"); ?>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Ficha de <?php echo $inmueble->referencia; ?>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

        <div class="form-group">            
            <?php echo label('Plantilla', 'plantilla_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
            <div class="col-sm-9">
                <?php echo form_dropdown('plantilla_id',$plantillas, $plantilla_id, 'id="plantilla_id" class="form-control"'); ?>
                <div id="marcas">
                </div>
            </div>
        </div>
        
        <div class="form-group">            
            <?php echo label('Idioma', 'idioma_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
            <div class="col-sm-9">
                <?php echo form_dropdown('idioma_id',$idiomas, $idioma_id, 'id="idioma_id" class="form-control"'); ?>
                <div id="marcas">
                </div>
            </div>
        </div>

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