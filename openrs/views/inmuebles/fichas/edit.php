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

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<div class="form-group">            
    <?php echo label('Contenido del documento', 'html', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php 
        //echo form_textarea($html,'','class="ckeditor" onchange="mark_modified_field();"'); 
        /* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
	$config_mini['filebrowserBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php";
	$config_mini['filebrowserImageBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php?type=inmuebles";
	$config_mini['filebrowserUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=inmuebles";
	$config_mini['filebrowserImageUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=inmuebles";	
	echo $this->ckeditor->editor($html['name'], $html['value'], $config_mini);
        ?>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-save bigger-110"></i>
            <?php echo lang('common_btn_edit'); ?>
        </button>
        <button class="btn btn-danger" id="delete" data-id="<?php echo $element->id; ?>">
            <i class="ace-icon fa fa-trash bigger-110"></i> 
            Eliminar
        </button>
    </div>
</div>

<?php echo form_hidden('id',$element->id); ?>

<?php echo form_close(); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {        
        show_submenu();
        
        $('#delete').click(function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url($_controller); ?>/delete/' + id;
                }
            });
        });
    })
</script>