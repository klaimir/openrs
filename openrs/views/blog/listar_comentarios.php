<div class="container-fluid admin-content">
	<div class="row">
		<section class="col-md-12">
			<article>
			<?php if($message == NULL || $message == 'borradores' || $message == 'eliminados' || $message == 'publicados'):?>
			<?php elseif($message == 'exito'):?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<p><b><?php echo $this->lang->line('blog_exito1');?></b></p>
					<p><?php echo $this->lang->line('blog_exito2');?></p>
				</div>
			<?php else: ?>
				<div class="alert alert-error">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<p><b><?php echo $this->lang->line('blog_error1');?></b></p>
					<p><?php echo $this->lang->line('blog_error2');?> <?php echo $message; ?>.</p>
					<p><?php echo $this->lang->line('blog_exito3');?></p>
				</div>
			<?php endif; ?>
			
			<h4><?php echo $this->lang->line('blog_comentarios_articulo');?> <?php echo $articulo->titulo; ?></h4>
			</article>
			<article>
			<?php if (count($comentarios) > 0): ?>
				<table class="table table-bordered table-hover table-condensed a_datatable">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('blog_table_creado');?></th><th><?php echo $this->lang->line('blog_contenido');?></th><th><?php echo $this->lang->line('blog_table_estado');?></th><th><?php echo $this->lang->line('blog_table_opciones');?></th>
						</tr>
					</thead>					
					<tbody>					
						<?php foreach ($comentarios as $coment): ?>
							<tr>
								<td><?php echo $coment->creado; ?></td>
								<td><?php echo nl2br($coment->contenido); ?></td>
								<td><?php if($coment->visible == 1){?>
										<span class="label label-success"><?php echo $this->lang->line('blog_visible');?></span>
									<?php }else{ ?>
										<span class="label label-danger"><?php echo $this->lang->line('blog_oculto');?></span>									
									<?php }?></td>
								<td>
									<span class="pull-right">
										<?php if($coment->visible==1):?>
											<a href="<?php echo site_url('blog/eliminar_comentario/'.$coment->id);?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_ocultar_comentario');?>">
												<i class="glyphicon glyphicon-trash"></i>
											</a>
										<?php else: ?>
											<a href="<?php echo site_url('blog/recuperar_comentario/'.$coment->id);?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $this->lang->line('blog_recuperar_comentario');?>">
												<i class="glyphicon glyphicon-share-alt"></i>
											</a>
										<?php endif; ?>
									</span>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info">No existen comentarios para este artículo</div>
			<?php endif; ?>
			</article>
		</section>
	</div>
</div>