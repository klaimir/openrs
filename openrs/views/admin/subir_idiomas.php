<?php $file = array(
	'name'=> 'upload',
	'class'=> 'form-control',
	'value' => set_value('upload'),
	'id'	=> 'upload'
);?>
<div class="container">
	<div class="row">
		<div class="col-sm-12" style="margin-top:50px">	
			<?php if(isset($message)): ?>
				<div class="well"><strong><?php echo $this->lang->line('admin_aviso');?></strong><br><?php echo $message;?></div><br>
			<?php endif; ?>	
			<?php echo form_open_multipart('admin/subir_idioma', array('class'=>'form-horizontal'));?>					
				<div class="col-sm-3">
					<?php echo form_dropdown('idioma', $idiomas, '', 'id = "idioma" class="vcenter"');?>
					<span style="color: red"><?php echo form_error('idioma');?></span>
				</div>
				<div class="col-sm-4">
					<?php // echo form_upload($file); ?>
					<input type="file" class="input-file" name="userfile" id="file">
					<span style="color: red"><?php echo form_error('upload'); ?> </span>
				</div>
				<div class="col-sm-2" style="margin-left:15px;">
					<?php echo form_submit(array('name'=>'submit','value'=>$this->lang->line('admin_subir_idioma_boton'),'class'=>'btn'));?>
				</div>
			<?php echo form_close();?>
		</div>
	</div>
</div>
