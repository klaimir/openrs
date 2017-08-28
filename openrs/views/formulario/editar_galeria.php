<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-danger pull-right">', '</div>');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2><?php echo $this->lang->line('cms_c_editar_imagen_galeria');?></h2>
		</div>
	</div>	
	<div class="row">		
		<div class="col-md-12">
		<?php echo form_open_multipart('',array('class'=>'form-horizontal')); ?>
				<ul class="nav nav-tabs">
					<?php foreach($cargar_idiomas as $idioma){ ?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<li class="active"><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }else{?>
							<li><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					<?php }?>
				</ul>
				<div class="tab-content">
					<?php foreach($cargar_idiomas as $idioma){?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<div class="tab-pane active" id="tab_<?php echo $idioma->id_idioma;?>">
						<?php }else{?>
							<div class="tab-pane" id="tab_<?php echo $idioma->id_idioma;?>">
						<?php }?>
						<h3><?php echo $this->lang->line('cms_galeria_editar_imagen');?></h3>
							<div class="col-md-10 col-md-offset-2">
								<img src="<?php echo base_url('uploads/general/img/carruselmini/'.$idioma->id_idioma.'/'.$imagen_carrusel[$idioma->id_idioma]->imagen_mini);?>" alt="<?php echo $imagen_carrusel[$idioma->id_idioma]->titulo_carrusel;?>" title="<?php echo $imagen_carrusel[$idioma->id_idioma]->titulo_carrusel;?>" />
								<p></p>
							</div>
							<?php $titulo_carrusel=array(
									'name'=>'titulo_carrusel_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
									'id'=>'titulo_carrusel_'.$idioma->id_idioma,
									'value'=> set_value('titulo_carrusel_'.$idioma->id_idioma,isset($imagen_carrusel[$idioma->id_idioma]->titulo_carrusel) ? $imagen_carrusel[$idioma->id_idioma]->titulo_carrusel : ''),
									'class'=>'form-control',
									'placeholder'=>$this->lang->line('cms_galeria_titulo_imagen')
								);
								$titulo_seo=array(
										'name'=>'titulo_seo_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
										'id'=>'titulo_seo_'.$idioma->id_idioma,
										'value'=> set_value('titulo_seo_'.$idioma->id_idioma,isset($imagen_carrusel[$idioma->id_idioma]->titulo_seo) ? $imagen_carrusel[$idioma->id_idioma]->titulo_seo : ''),
										'class'=>'form-control',
										'placeholder'=>$this->lang->line('cms_galeria_titulo_seo_imagen')
								);
							
								$texto_carrusel=array(
										'name'=>'texto_carrusel_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
										'id'=>'texto_carrusel_'.$idioma->id_idioma,
										'value'=> set_value('texto_carrusel_'.$idioma->id_idioma,isset($imagen_carrusel[$idioma->id_idioma]->texto_carrusel) ? $imagen_carrusel[$idioma->id_idioma]->texto_carrusel : ''),
										'class'=>'form-control',
										'rows'=>3,
										'placeholder'=>$this->lang->line('cms_galeria_texto_imagen')
								); ?>
								<div class="form-group">
									<div class="col-md-2">
										<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_titulo');?></label>
									</div>
									<div class="col-md-10">
										<?php echo form_input($titulo_carrusel); ?>
										<span><?php echo form_error('titulo_carrusel_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_titulo_seo');?></label>
									</div>
									<div class="col-md-10">
										<?php echo form_input($titulo_seo); ?>
										<span><?php echo form_error('titulo_seo_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_texto');?></label>
									</div>
									<div class="col-md-10">
										<?php echo form_textarea($texto_carrusel); ?>
										<span><?php echo form_error('texto_carrusel_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<div>
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_imagen');?></label>
										</div>
										
										<div class="col-md-10">
											<div class="pull-left">
												<label for="userfile_<?php echo $idioma->id_idioma;?>"><?php echo $this->lang->line('cms_galeria_imagen_seleccionar_archivo');?></label>
												<input type="file" class="" name="userfile_<?php echo $idioma->id_idioma;?>" id="userfile_<?php echo $idioma->id_idioma;?>">
											</div>
										</div>
									</div>
									<?php if(isset($error) && $error == 'error'):?>
										<div class="col-md-10 col-md-offset-2">
											<div class="controls">
												<div class="alert alert-danger">
													<?php echo $this->lang->line('cms_galeria_imagen_error1');?>
												</div>
											</div>
										</div>
									<?php elseif(isset($error) && $error == 'no_image'): ?>
										<div class="form-group">
											<div class="col-md-10 col-md-offset-2">
												<div class="alert alert-danger">
													<?php echo $this->lang->line('cms_galeria_imagen_error2');?>
												</div>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
						<?php }?>
					<div class="form-group">
						<div class="col-md-2">
							<?php echo form_label($this->lang->line('cms_galeria_categoria'),'id_categoria',array('class'=>'control-label pull-right')); ?>
						</div>
						<div class="col-md-4">
							<?php echo form_dropdown('id_categoria',$dd_categoria, (isset($imagen_carrusel[$idioma_actual->id_idioma]->id_categoria)?$imagen_carrusel[$idioma_actual->id_idioma]->id_categoria:''),'class=form-control'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-10 col-md-offset-2">
							<?php echo form_submit(array('name'=>'submit','value'=>isset($imagen_carrusel[$idioma_actual->id_idioma])?$this->lang->line('cms_editar'):$this->lang->line('cms_galeria_anadir_imagen'),'class'=>'btn btn-default')); ?>
						</div>
					</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>		