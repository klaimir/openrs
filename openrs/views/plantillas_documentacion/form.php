<div class="form-group">            
    <?php echo label('Nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($nombre, '', 'class="form-control"'); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Descripción', 'descripcion', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($descripcion, '', 'class="form-control"'); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Tipo de plantilla', 'tipo_plantilla_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_dropdown('tipo_plantilla_id',$tipos_plantillas,$tipo_plantilla_id, 'id="tipo_plantilla_id" onchange="show_marcas();"'); ?>
        <div id="marcas">
        </div>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Texto', 'html', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php
        //echo form_textarea($html,'','class="ckeditor"'); 
        
        /* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
	$config_mini['filebrowserBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php";
	$config_mini['filebrowserImageBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php?type=general";
	$config_mini['filebrowserUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=general";
	$config_mini['filebrowserImageUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=general";	
	echo $this->ckeditor->editor($html['name'], $html['value'], $config_mini);
        ?>        
    </div>
</div>

<script>
    function show_marcas() {
        var tipo_plantilla_id=$('#tipo_plantilla_id').val();
        $('#marcas').load('<?php echo site_url("plantillas_documentacion/show_marcas");?>/'+tipo_plantilla_id);
    }
    
    if($('#tipo_plantilla_id').val()) {
        show_marcas();
    }
</script>
