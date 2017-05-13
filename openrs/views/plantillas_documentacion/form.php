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
        <?php echo form_dropdown('tipo_plantilla_id',$tipos_plantillas,$tipo_plantilla_id); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Texto', 'html', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_textarea($html,'','class="ckeditor"'); ?>
    </div>
</div>
