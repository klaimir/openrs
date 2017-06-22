<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
<div class="form-group">            
    <?php echo label('Estado', 'evaluacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_dropdown('evaluacion_id',$evaluaciones,$evaluacion_id, 'onchange="mark_modified_field();" class="form-control" id="evaluacion_id"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('Observaciones', 'observaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_textarea($observaciones,'','onchange="mark_modified_field();" class="form-control"'); ?>
    </div>
</div>