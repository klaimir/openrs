<div class="form-group">            
    <?php echo label('Texto del fichero', 'texto_fichero', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($texto_fichero, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('Fichero a adjuntar', 'fichero', 'class="col-sm-3 control-label no-padding-right" onchange="mark_modified_field();"'); ?>
    <div class="col-sm-9">
        <input type="file" id="fichero" name="fichero" size="20"  />
    </div>
</div>
<div class="form-group">            
    <?php echo label('Tipo', 'tipo_fichero_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_dropdown('tipo_fichero_id',$tipos_ficheros,$tipo_fichero_id, 'id="tipo_fichero_id" onchange="mark_modified_field();" class="form-control"'); ?>        
    </div>                
</div>