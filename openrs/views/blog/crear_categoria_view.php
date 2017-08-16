<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-danger pull-left">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<section class="col-md-12">
		<?php echo form_open('',array('class'=>'form-horizontal')); ?>
			<?php if(isset($categoria)){
				echo form_hidden('id_categoria', $id_categoria);
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
				<?php foreach($cargar_idiomas as $idioma){?>
					<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
						<div class="tab-pane active" id="tab_<?php echo $idioma->id_idioma;?>">
					<?php }else{?>
						<div class="tab-pane" id="tab_<?php echo $idioma->id_idioma;?>">
					<?php }?>
					<h4><?php echo isset($categoria) ? $this->lang->line('blog_editar_categoria') : $this->lang->line('blog_crear_categoria');?></h4>
						<article>
								<?php echo form_hidden('idiomas[]', $idioma->id_idioma);?>
								<?php $nombre=array(
									'name'=>'nombre_'.$idioma->id_idioma,
									'id'=>'nombre_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('nombre_'.$idioma->id_idioma,isset($categoria[$idioma->id_idioma]->categoria) ? $categoria[$idioma->id_idioma]->categoria : ''),
								); 
								$url_seo=array(
									'name'=>'url_seo_'.$idioma->id_idioma,
									'id'=>'url_seo_'.$idioma->id_idioma,
									'class'=>'form-control',
									'value'=>set_value('url_seo_'.$idioma->id_idioma,isset($categoria[$idioma->id_idioma]->url_seo_categoria_blog) ? $categoria[$idioma->id_idioma]->url_seo_categoria_blog : ''),
								);
								?>

								<div class="form-group">
									<div class="col-md-2">
										<?php echo form_label($this->lang->line('blog_titulo'),'nombre_'.$idioma->id_idioma,array('class'=>'control-label pull-right')); ?>
									</div>
									<div class="col-md-10">
										<?php echo form_input($nombre); ?>
										<span><?php echo form_error('nombre_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
								<?php if(isset($error)):?>
									<?php  if($error == 'error'):?>
									<div class="col-md-offset-2">
										<div class="form-group">
												<div class="alert alert-danger pull-left"><?php echo $this->lang->line('blog_error_imagen1');?></div>
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
						</article>
					</div>
				<?php }?>
			</div>
			<div class="col-md-8 col-md-offset-4">
				<?php if(isset($categoria)){
					echo form_submit(array('name'=>'editar','value'=>$this->lang->line('blog_editar_categoria'),'class'=>'btn enviar'));
				}else{
					echo form_submit(array('name'=>'crear','value'=>$this->lang->line('blog_crear_categoria'),'class'=>'btn enviar'));
				}?>
			</div>
			<?php echo form_close(); ?>
		</section>
	</div>
</div>
