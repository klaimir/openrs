<div class="form-group">
	<div class="col-md-2 fuente-comentario">
		<label class="control-label pull-right" for="<?php echo $name; ?>"><?php echo $label; ?></label>
	</div>
	<div class="col-md-10">
		<input type="text" class="<?php echo $class; ?>" id="<?php echo $id; ?>" value="<?php echo $value; ?>" name="<?=$name?>">
		<?php if (isset($help)) { ?>
			<p class="help-block"><?php echo $help; ?></p>
		<?php } ?>
	</div>
 </div>