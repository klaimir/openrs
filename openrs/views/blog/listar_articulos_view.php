<?php $this->load->view('javascript/datatable');?>
<?php $this->load->view('javascript/global');?>
<div class="container admin-content">
	<div class="row">
		<section class="col-sm-12">		
			<div class="col-sm-8">				
				<h4><?php echo $this->lang->line('blog_listado_articulos');?></h4>
			</div>
                        <div class="col-sm-4">
                            <a href="<?php echo site_url('blog/crear_articulo'); ?>" class="btn btn-primary pull-right">Nuevo artículo </a>
                            <a href="<?php echo site_url('blog/listar_categorias'); ?>" class="btn btn-default pull-right">Listar categorías</a>
                        </div>
			<article>
			<?php if (count($articulos) > 0): ?>
				<table class="table table-bordered table-striped table-condensed a_datatable">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('blog_table_creado');?></th><th><?php echo $this->lang->line('blog_table_visto_votos');?></th><th><?php echo $this->lang->line('blog_table_imagen');?></th><th><?php echo $this->lang->line('blog_table_titulo');?></th><th><?php echo $this->lang->line('blog_url_seo');?></th><th><?php echo $this->lang->line('blog_table_categorias');?></th><th><?php echo $this->lang->line('blog_table_etiquetas');?></th><th><?php echo $this->lang->line('blog_table_estado');?></th><th><?php echo $this->lang->line('blog_table_opciones');?></th>
						</tr>
					</thead>				
					<tbody>					
						<?php foreach ($articulos as $art): ?>
							<tr>
								<td><?=$art->creado?></td>
								<td><?=$art->visitas." / ".$art->num_votos; ?></td>
								<td><img src="<?php echo base_url('uploads/general/img/blogmini/1/'.$art->id_idioma.'/'.$art->img_articulo_mini); ?>" /></td>
								<td><?=$art->titulo?></td>
								<td><?=$art->url_seo_articulo?></td>
								<td><?php foreach($art->categorias as $cat){ ?>
										<?php echo $cat->categoria;?>
									<?php }	?>
								</td>
								<td><?php foreach($art->etiquetas as $etiq){ ?>
										<span class="label label-default"><?php echo $etiq->etiqueta;?></span>
									<?php }	?>
								</td>
								<td><?php if($art->id_estado == 1){ ?>
										<span class="label label-success"><?php echo $this->lang->line('blog_estado1');?></span>
									<?php }elseif($art->id_estado == 2){ ?>
										<span class="label label-danger"><?php echo $this->lang->line('blog_estado2');?></span>
									<?php }elseif($art->id_estado == 3){ ?>
										<span class="label label-info"><?php echo $this->lang->line('blog_estado3');?></span>
									<?php }?>
								</td>
								<td>
									<span class="pull-right">
										<a href="<?php echo site_url('blog/listar_comentarios/'.$art->id_articulo);?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_listar_comentarios');?>">
											<i class="ace-icon fa fa-list bigger-130"></i><?php echo ($art->comentario == 1) ? '<big><strong>!</strong></big>' : '';?>
										</a>										
										<?php if($art->id_estado!=2):?>
											<a href="<?php echo site_url('blog/editar_articulo/'.$art->id_articulo);?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_editar_articulo');?>">
												<i class="ace-icon fa fa-pencil bigger-130"></i>
											</a>
										<?php else: ?>
											<a href="<?php echo site_url('blog/recuperar_articulo/'.$art->id_articulo);?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_recuperar_articulo');?>">
												<i class="ace-icon fa fa-external-link1 bigger-130"></i>
											</a>
										<?php endif; ?>										
										<a href="<?php echo site_url('blog/'.$art->url_seo_articulo);?>" target="_blank" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_ver_articulo');?>">
											<i class="ace-icon fa fa-eye bigger-130"></i>
										</a>
									</span>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info col-sm-12 margin-top-20"><?php echo $this->lang->line('blog_no_hay_articulos');?></div>
			<?php endif; ?>
			</article>
		</section>
	</div>
</div>
