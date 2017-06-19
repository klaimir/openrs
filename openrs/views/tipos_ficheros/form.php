<div class="form-group">            
    <?php echo label('Nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($nombre, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Descripción', 'descripcion', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($descripcion, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<?php if(isset($ambito_id)) { ?>
<div class="form-group">            
    <?php echo label('Ámbito', 'ambito_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_dropdown('ambito_id',$ambitos,$ambito_id, 'id="ambito_id" class="form-control" onchange="mark_modified_field();"'); ?>        
        <small class="blue">Una vez definido el ámbito de actuación del tipo de fichero ya no podrá cambiarlo</small>
    </div>    
</div>
<?php } ?>