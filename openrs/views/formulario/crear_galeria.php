<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
	
	$por_pagina=array(
			'name'=>'por_pagina', //name = nombre del campo en la base de datos
			'id'=>'por_pagina',
			'value'=> set_value('por_pagina',isset($carrusel_bloque->por_pagina) ? $carrusel_bloque->por_pagina : ''),
			'class'=>'form-control',
			'placeholder'=>$this->lang->line('cms_galeria_imagenes_pagina'),
			'required'=>'required',
	);
	$maximo=array(
			'name'=>'maximo', //name = nombre del campo en la base de datos
			'id'=>'maximo',
			'value'=> set_value('titulo_carrusel',isset($carrusel_bloque->maximo) ? $carrusel_bloque->maximo : ''),
			'class'=>'form-control',
			'placeholder'=>$this->lang->line('cms_galeria_numero_imagenes'),
			'required'=>'required',
	);?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url('page/listar_bloques/'.$seccion->url_seo);?>" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> <?php echo $seccion->titulo?></a>
		</div>
		<div class="col-md-12">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" ><a href="<?php echo site_url('page/crear_bloque/'.$seccion->url_seo.'/'.$carrusel_bloque->id_bloque);?>"><?php echo $this->lang->line('cms_bloques_paso1');?></a></li>
				<li role="presentation" class="active"><a><?php echo $this->lang->line('cms_bloques_paso2');?></a></li>
			</ul>
		</div>
		<div class="col-md-12">
			<h2><?php echo $this->lang->line('cms_datos_galeria');?></h2>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<?php echo form_open_multipart('',array('class'=>'form-horizontal')); ?>
			<div class="form-group">
				<div class="col-md-2">
					<?php echo form_label($this->lang->line('cms_galeria_tipo_galeria'),'tipo_carrusel',array('class'=>'control-label pull-right')); ?>
				</div>
			    <div class="col-md-6">
			    	<?php echo form_dropdown('tipo_carrusel',$dd_tipo_galeria, (isset($carrusel_bloque->tipo_carrusel)?$carrusel_bloque->tipo_carrusel:''),'class=form-control'); ?>
			    	<span><?php echo form_error('tipo_carrusel'); ?></span>
					<p></p>
			    </div>
			</div>
			<div class="form-group">
				<div class="col-md-2">
					<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_imagenes_pagina');?></label>
				</div>
				<div class="col-md-10">
					<?php echo form_input($por_pagina); ?>
					<span><?php echo form_error('por_pagina'); ?></span>
					<p></p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2">
					<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_numero_imagenes');?></label>
				</div>
				<div class="col-md-10">
					<?php echo form_input($maximo); ?>
					<span><?php echo form_error('maximo'); ?></span>
					<p></p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-2">
					<?php echo form_label($this->lang->line('cms_galeria_numero_columnas'),'columnas',array('class'=>'control-label pull-right')); ?>
				</div>
			    <div class="col-md-4">
			    	<?php echo form_dropdown('columnas',$dd_columnas, (isset($carrusel_bloque->columnas)?$carrusel_bloque->columnas:''),'class=form-control'); ?>
			    </div>
			</div>
			<div class="form-group">
				<div class="col-md-10 col-md-offset-2">
					<?php echo form_submit(array('name'=>'submit_carrusel','value'=>$this->lang->line('cms_guardar'),'class'=>'btn btn-default')); ?>
				</div>
			</div>
		<?php echo form_close(); ?>	
		</div>
	</div>
	<div class="row">
		<div class="col-md-12"><h3><?php echo $this->lang->line('cms_galeria_imagenes');?></h3></div>
		<?php if (!isset($imagen_carrusel)):?>
			<?php if($imagenes==false):?>
				<div class="col-md-12">
					<div class="alert alert-info" role="alert">
						<?php echo $this->lang->line('cms_galeria_no_imagenes');?>
					</div>
				</div>
			<?php else: ?>
				<div class="col-md-12" style="margin-bottom:20px;">
					<a href="<?php echo site_url('page/ordenar_carrusel/'.$id_carrusel);?>" class="btn btn-default"><?php echo $this->lang->line('cms_galeria_ordenar_imagenes');?></a>
				</div>
				<?php foreach($carrusel as $img):?>
					<div class="col-md-2">
						<div class="carrusel_mini">
							<img src="<?php echo base_url('uploads/general/img/carruselmini/'.$idioma_actual->id_idioma.'/'.$img->imagen_mini);?>" alt="<?php echo $img->titulo_carrusel;?>" title="<?php echo $img->titulo_carrusel;?>" class="img-responsive"/>
							<p><?php echo $img->titulo_carrusel;?></p>
							<?php if (!isset($imagen_carrusel)):?>
								<a href="<?php echo site_url('page/editar_carrusel/'.$img->id_imagen_carrusel); ?>" class="btn btn-default" title="<?php echo $this->lang->line('cms_editar');?>"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="<?php echo site_url('page/eliminar_imagen_carrusel/'.$img->id_imagen_carrusel); ?>" class="btn btn-danger" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-md-12"><h3><?php echo $this->lang->line('cms_galeria_categorias');?></h3></div>
		<?php if (isset($categoria_carrusel)):?>
			<?php if($categorias==false):?>
				<div class="col-md-12">
					<div class="alert alert-info" role="alert">
						<?php echo $this->lang->line('cms_galeria_no_categorias');?>
					</div>
				</div>
			<?php else: ?>
				<div class="col-md-12">
					<a href="<?php echo site_url('page/ordenar_carrusel_categorias/'.$id_carrusel);?>" class="btn btn-default"><?php echo $this->lang->line('cms_galeria_ordenar_categorias')?></a>
				</div>
				<?php foreach($categoria_carrusel as $cat):?>
					<div class="col-md-2">
						<div class="carrusel_mini">
							<h4><span class="label label-primary"><?php echo $cat->nombre_cat;?></span></h4>
							<?php if (isset($categoria_carrusel)):?>
								<a href="<?php echo site_url('page/editar_carrusel_categoria/'.$cat->id); ?>" class="btn btn-default" title="<?php echo $this->lang->line('cms_editar');?>"><span class="glyphicon glyphicon-edit"></span></a>
								<a href="<?php echo site_url('page/eliminar_carrusel_categoria/'.$cat->id); ?>" class="btn btn-danger" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach;?>
			<?php endif;?>
		<?php endif; ?>
	</div>
	<div class="row">
		<div class="col-md-12"><a class="btn btn-primary btn-mostrar"><?php echo $this->lang->line('cms_galeria_anadir_imagen');?></a></div>
	</div>
	
	<div class="row oculto" style="display:none;">
		<?php if (!isset($imagen_carrusel)):?>
			<div class="col-md-12">
				<h3><?php echo $this->lang->line('cms_galeria_anadir_nueva_imagen');?></h3>
			</div>
		<?php else: ?>
			<div class="col-md-12">
				<h3><?php echo $this->lang->line('cms_galeria_editar_imagen');?></h3>
				<div class="col-md-10 col-md-offset-2">
					<img src="<?php echo base_url('uploads/general/img/carruselmini/'.$idioma_actual->id_idioma.'/'.$imagen_carrusel->imagen_mini);?>" alt="<?php echo $imagen_carrusel->titulo_carrusel;?>" title="<?php echo $imagen_carrusel->titulo_carrusel;?>" />
					<p></p>
				</div>
			</div>
		<?php endif; ?>
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
							<?php $titulo_carrusel=array(
									'name'=>'titulo_carrusel_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
									'id'=>'titulo_carrusel_'.$idioma->id_idioma,
									'value'=> set_value('titulo_carrusel_'.$idioma->id_idioma,isset($imagen_carrusel->titulo_carrusel) ? $imagen_carrusel->titulo_carrusel : ''),
									'class'=>'form-control',
									'placeholder'=>$this->lang->line('cms_galeria_titulo_imagen')
								);
								$titulo_seo=array(
										'name'=>'titulo_seo_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
										'id'=>'titulo_seo_'.$idioma->id_idioma,
										'value'=> set_value('titulo_seo_'.$idioma->id_idioma,isset($imagen_carrusel->titulo_seo) ? $imagen_carrusel->titulo_seo : ''),
										'class'=>'form-control',
										'placeholder'=>$this->lang->line('cms_galeria_titulo_seo_imagen')
								);
							
								$texto_carrusel=array(
										'name'=>'texto_carrusel_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
										'id'=>'texto_carrusel_'.$idioma->id_idioma,
										'value'=> set_value('texto_carrusel_'.$idioma->id_idioma,isset($imagen_carrusel->texto_carrusel) ? $imagen_carrusel->texto_carrusel : ''),
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
								<?php echo form_dropdown('id_categoria',$dd_categoria, (isset($imagen_carrusel->id_categoria)?$imagen_carrusel->id_categoria:''),'class=form-control'); ?>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-10 col-md-offset-2">
								<?php echo form_submit(array('name'=>'submit_imagen','value'=>isset($imagen_carrusel)?$this->lang->line('cms_editar'):$this->lang->line('cms_galeria_anadir_imagen'),'class'=>'btn btn-default')); ?>
							</div>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="row" style="margin-top:20px;">
		<div class="col-md-12"><a class="btn btn-primary btn-mostrar-2"><?php echo $this->lang->line('cms_galeria_anadir_categoria');?></a></div>
	</div>
	
	<div class="row oculto-2" style="display:none;">
		<div class="col-md-12">
			<h3><?php echo $this->lang->line('cms_galeria_anadir_nueva_categoria');?></h3>
		</div>
		
		<div class="col-md-12">
			<?php echo form_open_multipart('',array('class'=>'form-horizontal')); ?>
				<ul class="nav nav-tabs">
					<?php foreach($cargar_idiomas as $idioma){ ?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<li class="active"><a href="#tab_categoria_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }else{?>
							<li><a href="#tab_categoria_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					<?php }?>
				</ul>
				<div class="tab-content">
					<?php foreach($cargar_idiomas as $idioma){?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<div class="tab-pane active" id="tab_categoria_<?php echo $idioma->id_idioma;?>">
						<?php }else{?>
							<div class="tab-pane" id="tab_categoria_<?php echo $idioma->id_idioma;?>">
						<?php }?>		
							<?php $nombre_cat=array(
									'name'=>'nombre_cat_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
									'id'=>'nombre_cat_'.$idioma->id_idioma,
									'value'=> set_value('nombre_cat_'.$idioma->id_idioma,isset($categoria_carrusel->nombre_cat) ? $categoria_carrusel->nombre_cat : ''),
									'class'=>'form-control',
									'placeholder'=>$this->lang->line('cms_galeria_nombre_categoria'),
									'required'=>'required',
							);						
							$descripcion_cat=array(
									'name'=>'descripcion_cat_'.$idioma->id_idioma, //name = nombre del campo en la base de datos
									'id'=>'descripcion_cat_'.$idioma->id_idioma,
									'value'=> set_value('descripcion_cat_'.$idioma->id_idioma,isset($categoria_carrusel->descripcion_cat) ? $categoria_carrusel->descripcion_cat : ''),
									'class'=>'form-control',
									'rows'=>3,
									'placeholder'=>$this->lang->line('cms_galeria_texto_categoria')
							);?>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_categoria_nombre')?></label>
								</div>
								<div class="col-md-10">
									<?php echo form_input($nombre_cat); ?>
									<span><?php echo form_error('nombre_cat_'.$idioma->id_idioma); ?></span>
									<p></p>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-2">
									<label class="control-label pull-right"><?php echo $this->lang->line('cms_galeria_categoria_texto')?></label>
								</div>
								<div class="col-md-10">
									<?php echo form_textarea($descripcion_cat); ?>
									<span><?php echo form_error('descripcion_cat_'.$idioma->id_idioma); ?></span>
									<p></p>
								</div>
							</div>
						</div>
					<?php }?>						
					<div class="form-group">
						<div class="col-md-10 col-md-offset-2">
							<?php echo form_submit(array('name'=>'submit_cat','value'=>$this->lang->line('cms_galeria_anadir_categoria'),'class'=>'btn btn-default')); ?>
						</div>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>	
<script>
    $(document).ready(function(){
       $('.btn-mostrar').click(function(){
		var ocultoDisplay=$('.oculto').css('display');
		if(ocultoDisplay=="none"){
			$('.oculto').slideDown();
			$('.btn-mostrar').text('Ocultar formulario');
		}else{
			$('.oculto').slideUp();
			$('.btn-mostrar').text('Añadir imagen');
		}
	});
	$('.btn-mostrar-2').click(function(){
		var ocultoDisplay=$('.oculto-2').css('display');
		if(ocultoDisplay=="none"){
			$('.oculto-2').slideDown();
			$('.btn-mostrar-2').text('Ocultar formulario');
		}else{
			$('.oculto-2').slideUp();
			$('.btn-mostrar-2').text('Añadir categoría');
		}
	}); 
    });
</script>