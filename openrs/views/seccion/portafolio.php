<div class="container-fluid">
	<div class="row">
		<!--<div class="col-lg-12">-->
		<div>
			<!--<h1><?php echo $seccion->titulo; ?></h1>-->
			<?php foreach ($bloques as $it):?>
				<?php if ($it->id_tipo_bloque == 1): //Bloque de texto?>
					<div class="col-lg-12">
						<h2><?php echo $it->titulo_bloque; ?></h2>
						<div><?php echo $it->texto->contenido;?></div>
					</div>
				<?php elseif ($it->id_tipo_bloque == 2):?>
					<?php if($it->carrusel_general->tipo_carrusel == 1):?>
						<div id="carousel-<?php echo $it->id_bloque;?>" class="carousel slide" data-ride="carousel">						  
							<ol class="carousel-indicators">
							  	<?php foreach ($it->carrusel as $car):?>
							  		<li data-target="#carousel-<?php echo $it->id_bloque;?>" data-slide-to="<?php echo ($car->prioridad-1); ?>" class="<?php ($car->prioridad == 1) ? "active" : ""; ?>"></li>
							  	<?php endforeach; ?>
							</ol>					  
						  	<div class="carousel-inner">
						  		<?php foreach ($it->carrusel as $car):?>
						  			<div class="item <?php echo ($car->prioridad == 1) ? "active" : ""; ?>">
						  				<img src="<?php echo base_url()."img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" alt="<?php echo $car->titulo_carrusel; ?>">
						  				<div class="carousel-caption">
								        	<h4><?php echo $car->titulo_carrusel; ?></h4>
								        	<p><?php echo $car->texto_carrusel; ?></p>
								      	</div>
						  			</div>
						  		<?php endforeach; ?>
						  	</div>
						
							  <a class="left carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="prev">
							    <span class="glyphicon glyphicon-chevron-left"></span>
							  </a>
							  <a class="right carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="next">
							    <span class="glyphicon glyphicon-chevron-right"></span>
							  </a>
						</div>
					<?php elseif($it->carrusel_general->tipo_carrusel == 3 || $it->carrusel_general->tipo_carrusel == 2):?>
						<div class="portafolio">
							<?php if(count($it->categorias) != 0):?>
							<div class="filtro">
								<ul class="nav nav-pills nav-justified">
									<li role="presentation" class="active cat-todos"><a>Todos</a></li>
									<?php foreach ($it->categorias as $cat):?>
										<li role="presentation" class="cat-top" id="<?php echo 'cat-'.$cat->id;?>"><a><?php echo $cat->nombre_cat; ?></a></li>
									<?php endforeach; ?>
								</ul>
							</div>
							<?php endif;?>
						<?php 
						$total=count($it->carrusel); 
						$num_paginas=$total/$it->carrusel_general->por_pagina;
						$contador=$cont_pag=0;
						$num_pagina=1;
						$maximo=$it->carrusel_general->maximo;
						?>
						<input type="hidden" id="por_pagina" value="<?php echo $it->carrusel_general->por_pagina;?>">
						<input type="hidden" id="maximo" value="<?php echo $maximo;?>">
						<div class="col-md-9 img-portafolio">
						<?php foreach($it->carrusel as $car):?>
							<div id="<?php echo $car->prioridad; ?>" class="<?php echo $col_md; ?> text-center img-galeria <?php echo 'cat-'.$car->id_categoria;?> <?php echo ($contador>=$it->carrusel_general->por_pagina  || $contador >= $maximo)?' oculto':'';?> <?php echo 'pagina-'.$num_pagina; ?>" >
								<?php if($it->carrusel_general->tipo_carrusel == 3):?>
									<?php $segments = array( 'evento', url_title( $car->titulo_seo, 'dash', true ));?>
									<a href="<?php echo site_url($segments);?>" class="text-center">
										<div class="tit-portafolio"><?php echo $car->titulo_carrusel;?></div>
										<img src="<?php echo base_url('img/carruselmini/'.$idioma_actual->id_idioma.'/'.$car->imagen_mini);?>" title="<?php echo $car->titulo_carrusel;?>" alt="<?php echo $car->titulo_carrusel;?>" class="img-responsive img-resp-gal"/>
									</a>
								<?php else: ?>
									<div data-toggle="modal" data-target="#myModal" class="porta-imagen">
										<div class="tit-portafolio"><?php echo $car->titulo_carrusel;?></div>
										<img src="<?php echo base_url('img/carruselmini/'.$idioma_actual->id_idioma.'/'.$car->imagen_mini);?>" title="<?php echo $car->titulo_carrusel;?>" alt="<?php echo $car->titulo_carrusel;?>" class="img-responsive img-resp-gal"/>
									</div>
								<?php endif;?>
							</div>
							<?php $contador++;?>
							<?php if($contador % $it->carrusel_general->por_pagina==0) $num_pagina++;?>
						<?php endforeach; ?>
						</div>
						<?php if($num_paginas>1):?>
							<div class="col-md-12">
								<ul class="pagination">
									<!-- <li>
								        <span aria-hidden="true">&laquo;</span>
								    </li> -->
									<?php for($i=0;$i<20;$i++):?>
										<?php if($cont_pag<$num_paginas):?>
									    	<li><span class="btn-pagina" id="<?php echo 'pagina-'.($i+1); ?>"><?php echo ($i+1); ?></span></li>
										<?php else: ?>
											<li><span class="btn-pagina oculto" id="<?php echo 'pagina-'.($i+1); ?>"><?php echo ($i+1); ?></span></li>
										<?php endif; ?>
										<?php $cont_pag++;?>
									<?php endfor;?>
									<!-- <li>
								        <span aria-hidden="true">&raquo;</span>
								    </li> -->
								</ul>
							</div>
						<?php endif;?>
						</div>
					<?php endif;?>
				<?php elseif($it->id_tipo_bloque == 3):?>
					<div class="fondo-blog col-lg-12">	
						<section class="col-md-9">
							<article>
								<div class="rowblog">
									<div class="">
										<?php if(count($articulos)!=0): ?>
											<?php $primero = TRUE; ?>
											<?php foreach ($articulos as $art): ?>
												<div class="articulo-blog <?php echo ($primero == TRUE) ? '' : 'borde-articulo';?>">
													<div class="substr-articulo">
														<?php if ($art->img_articulo != ''): ?>
															<div class="text-center">
																<img src="<?php echo base_url('img/blog/'.$art->id_autor.'/'.$art->id_idioma.'/'.$art->img_articulo);?>" class="img-responsive" alt="<?php echo $art->titulo; ?>" title="<?php echo $art->titulo; ?>"/>
															</div>
															<p></p>
														<?php endif; ?>
														<div class="titulo-blog">
															<?php $segments = array('blog', $art->url_seo_articulo);?>
															<h2 class="text-center"><a href="<?php echo site_url($segments); ?>"><?php echo $art->titulo; ?></a></h2>
														</div>
														<div class="etiqueta">
															<?php foreach($etiquetas[$art->id_articulo] as $etiq): ?>
																<h4 class="text-center"><?php echo $etiq->etiqueta; ?></h4>
															<?php endforeach; ?>
														</div>
														<div>
															<?php echo nl2br($art->descripcion).' <a href="'.site_url($segments).'"> <b>'.$this->lang->line('blog_seguir_leyendo').' >></b></a>';?>
														</div>
														<div class="preentrada-blog">
															<?php setlocale(LC_ALL,"es_ES");
															echo date("d F Y | <b>H:i:s</b>", strtotime($art->creado));?>
														</div>
													</div>		
												</div>
												<?php $primero = FALSE;
											endforeach;?>
											<div class="pagination pagination-centered">
												<?php echo $paginacion; ?>
											</div>
										<?php else: ?>
											<div class="error">
												<div class="text-center">
													<h2><?php echo $this->lang->line('blog_no_hay_articulos');?></h2>
												</div>
												<p class="alert text-center"><?php echo $this->lang->line('blog_no_hay_noticias');?><br><br>
												<a href="<?php echo site_url(''); ?>"><?php echo $this->config->item('site_name');?></a></p>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</article>
						</section>
						<section class="col-md-3">
							<div class="texto-derecha">
							
							<!-- Artículos más vistos -->
								<article>
									<h4 class="text-center"><?php echo $this->lang->line('blog_mas_vistos');?></h4>
									<?php foreach($articulos_populares as $popular):?>
										<div class="art_relacionado">
											<div class="row">							
												<div class="text-center">
													<a href="<?php echo site_url('blog/'.$popular->url_seo_articulo); ?>"><?php echo $popular->titulo; ?></a>
												</div>								
											</div>
										</div>
									<?php endforeach; ?>
								</article>
							<!-- Artículos más votados -->
								<article>
									<h4 class="text-center"><?php echo $this->lang->line('blog_mas_votados');?></h4>
									<?php foreach($articulos_votados as $votado):?>
										<div class="art_relacionado">
											<div class="row">							
												<div class="text-center">
													<a href="<?php echo site_url('blog/'.$votado->url_seo_articulo); ?>"><?php echo $votado->titulo; ?></a>
												</div>								
											</div>
										</div>
									<?php endforeach; ?>
								</article>
								<article id="etiquetas-fav">
									<h4 class="text-center"><?php echo $this->lang->line('blog_categorias');?></h4>
									<?php foreach($etiquetas_favoritas as $favorita):?>
										<div class="text-center">
											<a href="<?php echo site_url('blog-articulos/'.$favorita->id_etiqueta); ?>">
												<span class="label-right"><?php echo $favorita->etiqueta.' ('.$favorita->repeticiones.')'; ?></span>
											</a>
										</div>
									<?php endforeach; ?>
								</article>
							</div>
						</section>
					</div>
				<?php endif;?>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<!-- Sólo para el carrusel -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-body">
      			<?php foreach ($bloques as $it):?>
      				<?php if ($it->id_tipo_bloque == 2):?>
      					<?php if($it->carrusel_general->tipo_carrusel == 2):?>
			        		<div id="carousel-<?php echo $it->id_bloque;?>" class="carousel slide" data-ride="carousel">	  
							  	<div class="carousel-inner">
							  		<?php foreach ($it->carrusel as $car):?>
							  			<div class="item <?php echo ($car->prioridad == 1) ? "active" : ""; ?>">
							  				<img src="<?php echo base_url()."img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" alt="<?php echo $car->titulo_carrusel; ?>">
							  				<div class="carousel-caption">
									        	<h4><?php echo $car->titulo_carrusel; ?></h4>
									        	<p><?php echo $car->texto_carrusel; ?></p>
									      	</div>
							  			</div>
							  		<?php endforeach; ?>
							  	</div>
								<a class="left carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="prev">
								    <span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="next">
								    <span class="glyphicon glyphicon-chevron-right"></span>
								</a>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>
      		</div>
    	</div>
  	</div>
</div>