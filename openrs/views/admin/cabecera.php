<?php $nombre=array(
		'name'=>'nombre',
		'id'=>'nombre',
		'label'=> $this->lang->line('admin_nombre_web'),
		'class'=>'form-control',
		'value'=>set_value('nombre',isset($config->nombre) ? $config->nombre : '')
);

$cabecera_fija = array(
		'name' => 'cabecera_fija',
		'id' => 'cabecera_fija',
		'value' => '1',
		'checked' => ($config->cabecera_fija==1)?TRUE:FALSE,
		'class'=> 'change_logo'
);
$cabecera_no_fija = array(
		'name' => 'cabecera_fija',
		'id' => 'cabecera_no_fija',
		'value' => '0',
		'checked' => ($config->cabecera_fija!=1)?TRUE:FALSE,
		'class'=> 'no_change_logo'
);
$ccabecera=array(
		'name'=>'ccabecera',
		'id'=>'ccabecera',
		'label'=> $this->lang->line('admin_color_cabecera'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('ccabecera',isset($config->ccabecera) ? $config->ccabecera : '')
);
$cfuentecabecera=array(
		'name'=>'cfuentecabecera',
		'id'=>'cfuentecabecera',
		'label'=> $this->lang->line('admin_color_fuente_cabecera'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cfuentecabecera',isset($config->cfuentecabecera) ? $config->cfuentecabecera : '')
);
$cbordecabecera=array(
		'name'=>'cbordecabecera',
		'id'=>'cbordecabecera',
		'label'=> $this->lang->line('admin_color_borde_cabecera'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cbordecabecera',isset($config->cbordecabecera) ? $config->cbordecabecera : '')
);
$cfondo=array(
		'name'=>'cfondo',
		'id'=>'cfondo',
		'label'=> $this->lang->line('admin_color_fondo'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cfondo',isset($config->cfondo) ? $config->cfondo : '')
);
$cfuentefondo=array(
		'name'=>'cfuentefondo',
		'id'=>'cfuentefondo',
		'label'=> $this->lang->line('admin_color_fuente_fondo'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cfuentefondo',isset($config->cfuentefondo) ? $config->cfuentefondo : '')
);
$cpie=array(
		'name'=>'cpie',
		'id'=>'cpie',
		'label'=> $this->lang->line('admin_color_pie'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cpie',isset($config->cpie) ? $config->cpie : '')
);
$cfuentepie=array(
		'name'=>'cfuentepie',
		'id'=>'cfuentepie',
		'label'=> $this->lang->line('admin_color_fuente_pie'),
		'class'=>'form-control input_color',
		'type'=>'color',
		'value'=>set_value('cfuentepie',isset($config->cfuentepie) ? $config->cfuentepie : '')
);
$change_logo = array(
		'name' => 'change_logo',
		'id' => 'change_logo',
		'value' => '1',
		'checked' => FALSE,
		'class'=> 'change_logo'
);
$no_change_logo = array(
		'name' => 'change_logo',
		'id' => 'no_change_logo',
		'value' => '0',
		'checked' => TRUE,
		'class'=> 'no_change_logo'
);?>

<div class="page-header">
    <h1>
        Gestionar cabecera
    </h1>
</div>
		<div class="col-sm-12">
			<?php if(isset($mensaje)){?>
				<div class="alert alert-<?php echo $color;?> alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  			<?php echo $mensaje;?>
				</div>
			<?php }?>
			<?php echo form_open_multipart(site_url('admin/modificarCabecera'), array('class'=>'form-horizontal'));?>
				<div class="form-group">
					<div class="control-label col-sm-2">
						<?php echo form_label($this->lang->line('admin_nombre_web'),'nombre');?>
					</div>
					<div class="col-sm-3">
						<?php echo form_input($nombre); ?>
						<span style="color: red"><?php echo form_error('nombre');?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2 vcenter">
						<?php echo form_label($this->lang->line('admin_cabecera_fija'),'cabecera_fija',array('class'=>'control-label pull-right', 'style'=>'padding-top:0px')); ?>
					</div>
					<div class="col-sm-9 vcenter">
						<div class="col-xs-2"><?php echo form_radio($cabecera_no_fija).' '.$this->lang->line('admin_no');?></div>
						<div class="col-xs-2"><?php echo form_radio($cabecera_fija).' '.$this->lang->line('admin_si');?></div>
						<p></p><span style="color:red"><?php echo form_error('cabecera_fija'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_cabecera'),'ccabecera',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($ccabecera);?>
						<span style="color:red"><?php echo form_error('ccabecera'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_fuente_cabecera'),'cfuentecabecera',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cfuentecabecera);?>
						<span style="color:red"><?php echo form_error('cfuentecabecera'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_borde_cabecera'),'cbordecabecera',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cbordecabecera);?>
						<span style="color:red"><?php echo form_error('cbordecabecera'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_fondo'),'cfondo',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cfondo);?>
						<span style="color:red"><?php echo form_error('cfondo'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_fuente_fondo'),'cfuentefondo',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cfuentefondo);?>
						<span style="color:red"><?php echo form_error('cfuentefondo'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_pie'),'cpie',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cpie);?>
						<span style="color:red"><?php echo form_error('cpie'); ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_color_fuente_pie'),'cfuentepie',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-1">
						<?php echo form_input($cfuentepie);?>
						<span style="color:red"><?php echo form_error('cfuentepie'); ?></span>
					</div>
				</div>
				<?php if(isset($config)): ?>
					<div class="form-group">
						<div class="col-sm-2 vcenter">
							<label class="control-label pull-right"><?php echo $this->lang->line('admin_logo_actual');?></label>
						</div>
						<div class="col-sm-9 vcenter">
							<div class="logo_marca">
								<?php if($config->imagen){?>
									<!-- Para paneles independientes -->
									<img src="<?php echo base_url('assets/admin/img/preferencias/'.$config->imagen); ?>" class="img-responsive">
								<?php }else{?>
									<?php echo $this->lang->line('admin_no_hay_logo');?>
								<?php }?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2 vcenter">
							<?php echo form_label($this->lang->line('admin_logo_modificar'),'change_logo',array('class'=>'control-label pull-right', 'style'=>'padding-top:0px')); ?>
						</div>
						<div class="col-sm-9 vcenter">
							<div class="col-xs-2"><?php echo form_radio($no_change_logo).' '.$this->lang->line('admin_no');?></div>
							<div class="col-xs-2"><?php echo form_radio($change_logo).' '.$this->lang->line('admin_si');?></div>
							<p></p><span style="color:red"><?php echo form_error('change_logo'); ?></span>
						</div>
					</div>
				<?php endif; ?>
				<div class="<?php echo (isset($config)) ? 'oculto' : ''; ?>">
					<div class="form-group">
						<div class="col-sm-2">
							<label class="control-label pull-right"><?php echo $this->lang->line('admin_imagen');?></label>
						</div>
						<div class="col-sm-10">
							<div class="input-file pull-left">
								<label for="file"><?php echo $this->lang->line('admin_seleccionar_archivo');?></label>
								<input type="file" class="input-file" name="userfile" id="file"/>
							</div>
						</div>
					</div>
				</div>
				<?php if(isset($error)):?>
					<?php if($error == 'error'):?>
						<div class="form-group">
							<div class="controls">
								<div class="alert alert-danger pull-left"><?php echo $this->lang->line('admin_error_logo1');?><br><?php echo $this->lang->line('admin_error_logo2');?><br><?php echo $this->lang->line('admin_error_logo3');?></div>
							</div>
						</div>
					<?php elseif($error == 'no_image'): ?>
						<div class="form-group">
							<div class="controls">
								<div class="alert alert-danger pull-left"><?php echo $this->lang->line('admin_error_logo4');?></div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>				
				<?php $atri=array(
						 	'id'=>'submit',
						 	'name'=>'submit',
						 	'content'=>$this->lang->line('admin_aplicar'),
						 	'type'=>'submit',
						 	'class'=>'btn btn-info'
				); ?>
				<br>
				<div class="clearfix form-actions">
		            <div class="col-md-offset-3 col-md-9">
		                <?php echo form_button($atri);
				echo ' '.anchor('cliente',$this->lang->line('admin_cancelar'),array('class'=>'btn'));?>
		            </div>
		        </div>
				
				<?php echo form_close(); ?>
			</div>
		</div>
	
