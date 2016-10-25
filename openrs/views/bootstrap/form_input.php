<?php if($type!='hidden'):?>
<div class="form-group">
	<div class="col-md-2">
		<?php echo form_label($label,$form_group['name'],array('class'=>$label_class)); ?>
	</div>
    <div class="<?php echo $class; ?>">
    	<?php 
    	switch($type){
			case 'input':
				echo form_input($form_group);
				break;
			case 'input_tienda':
				echo form_input($form_group).' '.$producto->unidad_corto;
				break;
			case 'textarea':
				echo form_textarea($form_group);
				break;
			case 'select':
				echo form_dropdown($form_group['name'],$dropdown, $form_group['value'],(isset($form_group['disabled'])?$form_group['disabled'].' ':'').'class="'.$form_group['class'].'" ');
				break;
			case 'select_tienda':
				echo form_dropdown($form_group['name'],$dropdown, $form_group['value'],(isset($form_group['disabled'])?$form_group['disabled'].' ':'').'class="'.$form_group['class'].'" ').' '.$producto->unidad_corto;
				break;
			case 'password':
				echo form_password($form_group);
				break;
			case 'radio':
				foreach($radio_buttons as $rb){
					echo '<label class="radio-inline">
							<input type="radio" name="'.$form_group['name'].'" value="'.$rb['value'].'" '.(($rb['checked']=='si') ? 'checked':'').'> '.$rb['label'].'
						  </label>';
				}
				break;
			case 'checkbox':
				echo '<label class="checkbox-inline">
				  		<input type="checkbox" name="'.$form_group['name'].'" value="'.$form_group['value'].'" '.(($form_group['checked']=='si') ? 'checked':'').'>
					  </label>';
				break;
			case 'color':
				echo form_input($form_group);
				break;
		}    
		?>
    	
    	<p></p><?php echo form_error($form_group['name']);?>
    </div>
</div>
<?php else: ?>
	<?php echo '<input type="hidden" value="'.$form_group['value'].'" name="'.$form_group['name'].'"/>'; ?>
<?php endif; ?>