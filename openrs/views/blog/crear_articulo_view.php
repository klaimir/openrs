<?php $this->load->view('javascript/etiquetas');?>
<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-danger pull-left">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<section class="col-md-12">
		<?php echo form_open_multipart('',array('class'=>'form-horizontal')); ?>
			<?php if(isset($articulo)){
				echo form_hidden('id_articulo', $id_articulo);
			}?>
			<!-- Only required for left/right tabs -->
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
				<?php $con=0;?>
				<?php foreach($cargar_idiomas as $idioma){?>
					<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
						<div class="tab-pane active" id="tab_<?php echo $idioma->id_idioma;?>">
					<?php }else{?>
						<div class="tab-pane" id="tab_<?php echo $idioma->id_idioma;?>">
					<?php }?>
					<h4><?php echo isset($articulo) ? $this->lang->line('blog_editar_articulo') : $this->lang->line('blog_crear_articulo');?></h4>
						<article>
								<?php echo form_hidden('idiomas[]', $idioma->id_idioma);?>
								<?php $titulo=array(
									'name'=>'titulo_'.$idioma->id_idioma,
									'id'=>'titulo_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('titulo_'.$idioma->id_idioma,isset($articulo[$idioma->id_idioma]->titulo) ? $articulo[$idioma->id_idioma]->titulo : ''),
								); 
								$url_seo=array(
									'name'=>'url_seo_'.$idioma->id_idioma,
									'id'=>'url_seo_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('url_seo_'.$idioma->id_idioma,isset($articulo[$idioma->id_idioma]->url_seo_articulo) ? $articulo[$idioma->id_idioma]->url_seo_articulo : ''),
								);
								$contenido=array(
									'name'=>'contenido_'.$idioma->id_idioma,
									'id'=>'contenido_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('contenido_'.$idioma->id_idioma,isset($articulo[$idioma->id_idioma]->contenido) ? $articulo[$idioma->id_idioma]->contenido : ''),
								);
								$ins_etiqueta=array(
									'name'=>'ins_etiqueta_'.$idioma->id_idioma,
									'id'=>'ins_etiqueta_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('ins_etiqueta_'.$idioma->id_idioma,''),
								);
								$descripcion=array(
									'name'=>'descripcion_'.$idioma->id_idioma,
									'id'=>'descripcion_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('descripcion_'.$idioma->id_idioma,isset($articulo[$idioma->id_idioma]->descripcion) ? $articulo[$idioma->id_idioma]->descripcion : ''),
								);
								$change_logo = array(
									'name' => 'change_logo_'.$idioma->id_idioma,
									'id' => 'change_logo_'.$idioma->id_idioma,
									'value' => '1',
									'checked' => FALSE,
									'class'=> 'change_logo'
								);
								$no_change_logo = array(
									'name' => 'change_logo_'.$idioma->id_idioma,
									'id' => 'no_change_logo_'.$idioma->id_idioma,
									'value' => '0',
									'checked' => TRUE,
									'class'=> 'no_change_logo'
								);?>

								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_titulo'),'titulo_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<?php echo form_input($titulo); ?>
										<span><?php echo form_error('titulo_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<?php if(isset($articulo)):
									$creado=array(
										'name'=>'creado_'.$idioma->id_idioma,
										'id'=>'creado_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('creado_'.$idioma->id_idioma, $articulo[$idioma->id_idioma]->creado),
									);?>
									<!-- Fecha de creacion -->
									<div class="form-group">
										<div class="col-sm-2">
											<?php echo form_label($this->lang->line('blog_fecha_creacion'),'creado_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
										</div>
										<div class="col-sm-2 input-group date" id="datetimepicker1">
											<?php echo form_input($creado); ?>
											<span class="input-group-addon">
						                        <span class="glyphicon glyphicon-calendar"></span>
						                    </span>
											<span style="color: red"><?php echo form_error('creado_'.$idioma->id_idioma); ?> </span>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label pull-right" style="padding-top:0px;"><?php echo $this->lang->line('blog_imagen_actual');?></label>
										</div>
										
										<div class="col-md-10">
											<div class="logo_marca">
												<?php if(($articulo[$idioma->id_idioma]->img_articulo)){?>
													<img src="<?php echo base_url('uploads/general/img/blog/1/'.$idioma->id_idioma.'/'.$articulo[$idioma->id_idioma]->img_articulo); ?>" class="img-responsive" />
												<?php }else{?>
													<?php echo $this->lang->line('blog_no_hay_imagen');?>
												<?php }?>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-2">
											<?php echo form_label($this->lang->line('blog_modificar_logo'),'change_logo_'.$idioma->id_idioma,array('class'=>'control-label pull-right','style'=>'padding-top:0px')); ?>
										</div>
										<div class="col-md-10">
											<div class="col-xs-1"><?php echo form_radio($no_change_logo).' '.$this->lang->line('blog_no'); ?></div>
											<div class="col-xs-1"><?php echo form_radio($change_logo).' '.$this->lang->line('blog_si'); ?></div>
											<p></p><div><?php echo form_error('change_logo_'.$idioma->id_idioma); ?></div>
										</div>
									</div>
								<?php endif; ?>
								<div class="<?php echo (isset($articulo)) ? 'oculto' : ''; ?>">
									<div class="form-group">
										<div class="col-md-2">
											<label class="control-label pull-right"><?php echo $this->lang->line('blog_imagen');?></label>
										</div>
										<div class="col-md-10">
											<div class="input-file pull-left">
												<label for="userfile_<?php echo $idioma->id_idioma;?>"><?php echo $this->lang->line('blog_seleccionar_archivo');?></label>
												<input type="file" class="input-file" name="userfile_<?php echo $idioma->id_idioma;?>" id="userfile_<?php echo $idioma->id_idioma;?>">
											</div>
										</div>
									</div>
								</div>
								<?php if(isset($error)):?>
									<?php  if($error == 'error'):?>
									<div class="col-md-offset-2">
										<div class="form-group">
												<div class="alert alert-danger pull-left"><?php echo $this->lang->line('blog_error_imagen1');?></div>
										</div>
									</div>
									<?php elseif($error == 'no_image'): ?>
									<div class="col-md-offset-2">
										<div class="form-group">
												<div class="alert alert-danger pull-left"><?php echo $this->lang->line('blog_error_imagen2');?></div>
										</div>
									</div>
									<?php endif; ?>
								<?php endif; ?>
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_url_seo'),'url_seo_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<?php echo form_input($url_seo); ?>
										<span><?php echo form_error('url_seo_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>							
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_descripcion_corta').' '.$this->lang->line('blog_descripcion_500'),'descripcion_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<?php echo form_textarea($descripcion); ?>
										<span><?php echo form_error('descripcion_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<span><?php echo form_error('contenido_'.$idioma->id_idioma); ?></span>
										<?php 
										$config_mini = array();
										$config_mini['toolbar'] = array(
												array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
										);
										$config_mini['filebrowserBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php";
										$config_mini['filebrowserImageBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php?type=general";
										$config_mini['filebrowserUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=general";
										$config_mini['filebrowserImageUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=general";
										echo $this->ckeditor->editor('contenido_'.$idioma->id_idioma, set_value('contenido_'.$idioma->id_idioma,isset($articulo[$idioma->id_idioma]->contenido) ? $articulo[$idioma->id_idioma]->contenido : ''), $config_mini);?>
										<p></p>
									</div>
									<p class="centrado" style="font-size:12px;"><b>NOTA: </b>Para dividir el contenido en columnas, debes pulsar en "Fuente HTML" y pegar uno de estos códigos</p>
									<p class="centrado" style="font-size:12px;">Para 2 columnas: &ltdiv class="col-md-6">Contenido&lt/div&gt &ltdiv class="col-md-6">Contenido&lt/div&gt</p>
									<p class="centrado" style="font-size:12px;">Para 3 columnas: &ltdiv class="col-md-4">Contenido&lt/div&gt &ltdiv class="col-md-4">Contenido&lt/div&gt &ltdiv class="col-md-4">Contenido&lt/div&gt</p>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_categorias'),'categorias_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<div class="categorias" id="categorias_<?php echo $idioma->id_idioma;?>">
											<?php if(isset($categorias[$idioma->id_idioma])){
												foreach($categorias[$idioma->id_idioma] as $cat){
													if(isset($articulo) && $con == 0){
														$asignada=$this->articulo_model->categoria_asignada($cat->id_categoria, $id_articulo);
														if($asignada)
															echo form_checkbox('campoCategorias[]', $cat->id_categoria, true).' '.$cat->categoria.' ';
														else 
															echo form_checkbox('campoCategorias[]', $cat->id_categoria).' '.$cat->categoria.' ';
													}else{
														echo form_checkbox('campoCategorias[]', $cat->id_categoria).' '.$cat->categoria.' ';
													}
												}
											}?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_etiquetas'),'etiquetas_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<div class="etiquetas" id="etiquetas_<?php echo $idioma->id_idioma;?>">
											<ul class="list-inline">
											<?php if(isset($articulo)){
												foreach($etiquetas[$idioma->id_idioma] as $etiq){?>
													<li class="alert alert-info del_etiqueta" id="<?php echo $etiq->etiqueta;?>"><?php echo $etiq->etiqueta.' x';?></li>
												<?php }
											}?>
											</ul>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_nueva_etiqueta'),'ins_etiqueta_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-xs-6">
										<?php echo form_input($ins_etiqueta); ?>
										<span><?php echo form_error('ins_etiqueta_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
									<div class="col-xs-1">
										<span class="btn btn-primary mas_etiqueta" id="masetiqueta_<?php echo $idioma->id_idioma;?>"> + </span>
									</div>
								</div>
								<!-- Input hidden para enviar las etiquetas que se han ido añadiendo -->
								<input type="hidden" name="todas_etiquetas_<?php echo $idioma->id_idioma;?>" id="todas_etiquetas_<?php echo $idioma->id_idioma;?>" value="" />
						</article>
					</div>
					<?php $con++;?>
				<?php }?>
			</div>
			<div class="col-md-8 col-md-offset-4">
				<?php echo form_submit(array('name'=>'publicar','value'=>$this->lang->line('blog_publicar'),'class'=>'btn enviar')); ?>
				<?php echo form_submit(array('name'=>'borrador','value'=>$this->lang->line('blog_guardar_borrador'),'class'=>'btn enviar')); ?>
				<?php echo isset($articulo) ? '<a href="'.site_url('blog-eliminar-articulo/'.$id_articulo).'" class="pull-right"><span class="btn btn-danger"><i class="icon-white icon-remove"></i>'.$this->lang->line('blog_eliminar').'</span></a>' : '';?>
			</div>
			<?php echo form_close(); ?>
		</section>
	</div>
</div>
<script>
//Eliminar etiqueta
$(".etiquetas").on("click", ".del_etiqueta", function(){
	$(this).remove();
	var id = $(this).attr('id').split('_');
	$('#ins_etiqueta_'+id[1]).focus();
});
//Comprobaciones al enviar un blog
$(".enviar").click(function(){
	//Recorre el listado de etiquetas y las almacena en el input hidden
	$('.etiquetas').each(function( index ) {
		var id = $(this).attr('id').split('_');
		$( "#etiquetas_"+id[1]+" li" ).each(function( index ) {
			$("#todas_etiquetas_"+id[1]).val($("#todas_etiquetas_"+id[1]).val()+$(this).attr("id")+';');
		});
	});
});
</script>