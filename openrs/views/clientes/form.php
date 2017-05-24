<div class="form-group">            
    <?php echo label('Nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($nombre, '', 'class="form-control"'); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Apellidos', 'apellidos', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($apellidos, '', 'class="form-control"'); ?>
    </div>
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('País de residencia', 'pais_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_dropdown('pais_id',$paises,$pais_id, 'id="pais_id" onchange="show_provincias();"'); ?>        
    </div>
</div>
<div id="provincias">
</div>
<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Observaciones', 'observaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_textarea($observaciones); ?>
    </div>
</div>

<script>
    function show_provincias() {
        var pais_id=$('#pais_id').val();
        $('#provincias').load('<?php echo site_url("provincias/show_provincias");?>/'+pais_id);
    }
    
    if($('#pais_id').val()==64) {
        show_provincias();
    }
</script>
