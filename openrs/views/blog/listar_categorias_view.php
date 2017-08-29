<div class="container admin-content">
	<div class="row">
		<a href="<?=site_url('blog/crear_categoria')?>" class="btn btn-primary pull-right">
			<?php echo $this->lang->line('blog_categoria_nueva');?>
		</a>
		<section>		
			<article>				
				<h4><?php echo $this->lang->line('blog_listado_categorias');?></h4>
			</article>
			<article>
			<?php if (count($categorias) > 0): ?>
				<table class="table table-bordered table-striped table-condensed a_datatable">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('blog_table_creado');?></th><th><?php echo $this->lang->line('blog_table_titulo');?></th><th><?php echo $this->lang->line('blog_url_seo');?></th><th><?php echo $this->lang->line('blog_table_opciones');?></th>
						</tr>
					</thead>				
					<tbody>					
						<?php foreach ($categorias as $cat): ?>
							<tr>
								<td><?=$cat->creada?></td>
								<td><?=$cat->categoria?></td>
								<td><?=$cat->url_seo_categoria_blog?></td>
								<td>
									<span class="pull-right">
										<a href="<?php echo site_url('blog/editar_categoria/'.$cat->id_categoria);?>" class="action-tooltip" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_editar_categoria');?>">
											<i class="glyphicon glyphicon-edit"></i>
										</a>
										<a href="<?php echo site_url('blog/eliminar_categoria/'.$cat->id_categoria);?>" class="action-tooltip" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_eliminar');?>">
											<i class="glyphicon glyphicon-trash"></i>
										</a>										
									</span>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info categoria-blog"><?php echo $this->lang->line('blog_no_hay_categorias');?></div>
			<?php endif; ?>
			</article>
		</section>
	</div>
</div>
