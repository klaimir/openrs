<div class="form-group">            
    <?php echo lang($_controller . '_label_nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($nombre); ?>
    </div>
</div>

<div class="form-group">            
    <?php echo lang($_controller . '_label_descripcion', 'descripcion', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($descripcion); ?>
    </div>
</div>