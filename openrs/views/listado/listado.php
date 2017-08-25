<?php $this->load->view('javascript/datatable');?>
<?php $this->load->view('javascript/global');?>
<div class="container-fluid">
	<div class="row">
		<section class="col-md-12">
			<div class="row">
				<div class="col-sm-8">
					<h2><?php echo $title; ?></h2>
				</div>
				<div class="col-sm-4">
					<?php foreach($botones as $kb=>$vb):?>
						<a href="<?php echo $vb['href'];?>" class="<?php echo $vb['class'];?>"><?php echo $vb['contenido'];?> </a>
					<?php endforeach;?>
				</div>
			</div>
			
			<article style="margin-top:15px;">
			<?php if (count($listado) > 0): ?>
				<table class="table table-bordered table-hover table-condensed">
					<thead>
						<tr>
							<?php  foreach ($columnas as $k=>$v): ?>
							     <th><?php echo $k;?></th>
							<?php  endforeach; ?>
							<?php if($opciones!=''):?>
						     	<th><?php echo $this->lang->line('cms_listado_opciones');?></th>		
						     <?php endif;?>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($listado as $it): ?>
							<tr>
								<?php  foreach ($columnas as $k=>$v): ?>
									<?php if($v == 'id_estado'){?>
										<td>
											<?php if($it->$v == '1'){?>
												<span class="label label-success"><?php echo $this->lang->line('cms_publicado');?></span>
											<?php }elseif($it->$v == '2'){?>
												<span class="label label-danger"><?php echo $this->lang->line('cms_eliminado');?></span>
											<?php }elseif($it->$v == '3'){?>
												<span class="label label-info"><?php echo $this->lang->line('cms_borrador');?></span>
											<?php }?>
										</td>
									<?php }else{?>
							     		<td><?php echo $it->$v;?></td>
							     	<?php }?>
								<?php  endforeach; ?>
								<?php if($opciones!=''):?>
							     		<td>
							     			<?php foreach($opciones as $ko=>$vo):?>
							     				<?php if($ko!='Borrar'):?>
								     				<a href="<?php echo $vo['href'];?><?php foreach($vo['keys'] as $key){ echo '/'.$it->$key; }?>" class="action-tooltip green" rel="tooltip" data-original-title="<?php echo $vo['title']; ?>">
								     					<span class="<?php echo $vo['icon'];?>"></span>
								     				</a>
								     			<?php else: ?>
								     				<a href="<?php echo $vo['href'];?><?php foreach($vo['keys'] as $key){ echo '/'.$it->$key; }?>" class="action-tooltip red" rel="tooltip" data-original-title="<?php echo $vo['title']; ?>">
								     					<span class="<?php echo $vo['icon'];?>" id="" ></span>
								     				</a>
								     			<?php endif;?>
							     			<?php endforeach;?>
							     		</td>
							     	<?php endif;?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div class="alert alert-info"><?php echo $this->lang->line('cms_seccion_no_existen_datos');?></div>
			<?php endif; ?>
			</article>
		</section>
	</div>
</div>