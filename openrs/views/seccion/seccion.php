<?php
//Seleccionar el formato de los mensajes de error
$this->form_validation->set_error_delimiters('<div class="alert alert-error pull-right">', '</div>');

// Primero defino los campos que voy a necesitar para el formulario
$nombre = array(
		'name'=>'nombre',
		'id'=>'nombre',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'placeholder' => 'Nombre y Apellidos'
		);
$empresa = array(
		'name'=>'empresa',
		'id'=>'empresa',
		'class'=>'form-control border-radius-8',
		'placeholder' => 'Empresa'
);
$email = array(
		'name'=>'email',
		'id'=>'email',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'pattern' => "[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+",
		'placeholder' => 'Email'
);
$telefono = array(
		'name'=>'telefono',
		'id'=>'telefono',
		'class'=>'form-control border-radius-8',
		'placeholder' => 'Teléfono'
);
$mensaje = array(
		'name'=>'mensaje',
		'id'=>'mensaje',
		'class'=>'form-control caja-mensaje border-radius-8',
		'rows'=>4,
		'required' => 'required',
		'placeholder' => 'Mensaje'
);
?>
<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
<div class="container-fluid">
	<div class="row">
		
			<?php foreach ($bloques as $it):?>
				<?php if ($it->id_tipo_bloque == 1): //Bloque de texto?>
					<div style="background:<?php echo $it->background;?>">
						<!-- <h3 class="titulo-bloque" style="text-align:center;color:<?php echo $it->c_titulo;?>;"><?php echo $it->titulo_bloque; ?></h3> -->
						<?php if($it->ancho == 1){?>
							<div><?php echo $it->texto->contenido;?></div>
						<?php }elseif($it->ancho == 2){?>
							<div class="container"><?php echo $it->texto->contenido;?></div>
						<?php }?>
					</div>
				<?php elseif ($it->id_tipo_bloque == 2):?>
					<?php if($it->carrusel_general->tipo_carrusel == 1):?>
						<div id="carousel-<?php echo $it->id_bloque;?>" class="carousel slide" data-ride="carousel">						  
							<?php if(count($it->carrusel) > 1):?>
							<ol class="carousel-indicators">
							  	<?php foreach ($it->carrusel as $car):?>
							  		<li data-target="#carousel-<?php echo $it->id_bloque;?>" data-slide-to="<?php echo ($car->prioridad-1); ?>" class="<?php ($car->prioridad == 1) ? "active" : ""; ?>"></li>
							  	<?php endforeach; ?>
							</ol>	
							<?php endif;?>				  
						  	<div class="carousel-inner">
						  		<?php foreach ($it->carrusel as $car):?>
						  			<div class="item <?php echo ($car->prioridad == 1) ? "active" : ""; ?>">
						  				<img src="<?php echo base_url()."uploads/general/img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" title="<?php echo $car->titulo_seo; ?>" alt="<?php echo $car->titulo_seo; ?>">
						  				<div class="carousel-caption hidden-xs">
								        	<h1><?php echo $car->titulo_carrusel; ?></h1>
								        	<h2><?php echo $car->texto_carrusel; ?></h2>
								      	</div>
						  			</div>
						  		<?php endforeach; ?>
						  	</div>
							<?php /*if(count($it->carrusel) > 1):?>
							  <a class="left carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="prev">
							    <span class="glyphicon glyphicon-chevron-left"></span>
							  </a>
							  <a class="right carousel-control" href="#carousel-<?php echo $it->id_bloque;?>" role="button" data-slide="next">
							    <span class="glyphicon glyphicon-chevron-right"></span>
							  </a>
							<?php endif;*/?>
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
						<div class="col-md-12 img-portafolio">
						<?php foreach($it->carrusel as $car):?>
							<div id="<?php echo $car->prioridad; ?>" class="<?php echo $col_md; ?> text-center img-galeria <?php echo 'cat-'.$car->id_categoria;?> <?php echo ($contador>=$it->carrusel_general->por_pagina  || $contador >= $maximo)?' oculto':'';?> <?php echo 'pagina-'.$num_pagina; ?>" >
								<?php if($it->carrusel_general->tipo_carrusel == 3):?>
									<a href="<?php echo site_url($car->titulo_seo);?>" class="text-center">
										<img src="<?php echo base_url('img/carruselmini/'.$idioma_actual->id_idioma.'/'.$car->imagen_mini);?>" title="<?php echo $car->titulo_carrusel;?>" alt="<?php echo $car->titulo_carrusel;?>" class="img-responsive img-resp-gal"/>
										<p class="titulo-portafolio"><?php echo $car->titulo_carrusel;?></p>
									</a>
								<?php else: ?>
									<div data-toggle="modal" data-target="#myModal" class="porta-imagen">
										<img src="<?php echo base_url('img/carruselmini/'.$idioma_actual->id_idioma.'/'.$car->imagen_mini);?>" title="<?php echo $car->titulo_carrusel;?>" alt="<?php echo $car->titulo_carrusel;?>" class="img-responsive img-resp-gal"/>
									</div>
								<?php endif;?>
							</div>
							<?php $contador++;?>
							<?php if($contador % $it->carrusel_general->por_pagina==0) $num_pagina++;?>
						<?php endforeach; ?>
						</div>
						<?php if($num_paginas>1):?>
							<div class="col-md-12 centrado">
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
					<?php elseif($it->carrusel_general->tipo_carrusel == 4):?>
						<div class="hidden-xs">
							<ul id="accordion">
							<?php foreach ($it->carrusel as $car):?>
						  		<li>
						  			<img src="<?php echo base_url()."img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" class="img-responsive" alt="<?php echo $car->titulo_carrusel; ?>">
						  		</li>
						  	<?php endforeach; ?>
							</ul>
						</div>
						<div class="hidden-sm hidden-md hidden-lg">
							<ul>
							<?php foreach ($it->carrusel as $car):?>
						  		<li>
						  			<img src="<?php echo base_url()."img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" class="img-responsive" alt="<?php echo $car->titulo_carrusel; ?>">
						  		</li>
						  	<?php endforeach; ?>
							</ul>
						</div>
					<?php endif;?>
				<?php elseif($it->id_tipo_bloque == 3):?>
					<div class="fondo-blog col-sm-12 hidden-xs">	
						<section class="col-sm-9">
							<article>
								<div class="rowblog">
									<div class="">
										<?php if(count($articulos)!=0): ?>
											<?php $primero = TRUE; ?>
											<?php 
												$total=count($articulos); 
												$num_paginas=$total/4;
												$contador=$cont_pag=0;
												$num_pagina=1;
												$maximo=4;
												?>
												<input type="hidden" id="por_pagina" value="4">
												<input type="hidden" id="maximo" value="<?php echo $maximo;?>">
											<?php foreach ($articulos as $art): ?>
												<div class="articulo-blog img-galeria <?php echo ($primero == TRUE) ? '' : 'borde-articulo';?> <?php echo ($contador>='4'  || $contador >= $maximo)?' oculto':'';?> <?php echo 'pagina-'.$num_pagina; ?>">
													
														<div class="titulo-blog">
															<?php $segments = array($this->uri->segment('1'), 'blog', $art->url_seo_articulo);?>
															<h3><a href="<?php echo site_url($segments); ?>"><?php echo $art->titulo; ?></a></h3>
														</div>
														<div class="descripcion-corta">
															<?php echo nl2br($art->descripcion).' <a href="'.site_url($segments).'"> <b>'.$this->lang->line('blog_seguir_leyendo').'</b></a>';?>
														</div>
														<?php if ($art->img_articulo != ''): ?>
															<div>
																<img src="<?php echo base_url('uploads/general/img/blog/1/'.$art->id_idioma.'/'.$art->img_articulo);?>" class="img-responsive" alt="<?php echo $art->titulo; ?>" title="<?php echo $art->titulo; ?>"/>
															</div>
															<p></p>
														<?php endif; ?>
																
												</div>
												<?php $contador++;?>
												<?php if(($contador % 4)==0) $num_pagina++;?>
												<?php $primero = FALSE;
											endforeach;?>
											<?php if($num_paginas>1):?>
												<div class="col-md-12">
													<ul class="pagination centrado">
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
										<?php else: ?>
											<div class="error">
												<div class="text-center">
													<h2><?php echo $this->lang->line('blog_no_hay_articulos');?></h2>
												</div>
												<p class="alert text-center"><?php echo $this->lang->line('blog_no_hay_noticias');?><br><br>
												<a href="<?php echo site_url(''); ?>"><?php echo $config->nombre;?></a></p>
											</div>
										<?php endif; ?>
									</div>
								</div>
							</article>
						</section>
						<section class="col-sm-3">
							<div class="texto-derecha">
							<!-- Artículos más vistos -->
								<article>
									<h5><?php echo $this->lang->line('blog_mas_vistos');?></h5>
									<?php foreach($articulos_populares as $popular):?>
										<div class="art_relacionado">
																		
												<div>
													<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$popular->url_seo_articulo); ?>"><?php echo $popular->titulo; ?></a>
												</div>								
											
										</div>
									<?php endforeach; ?>
								</article>
							<!-- Artículos más votados -->
								<article>
									<h5><?php echo $this->lang->line('blog_mas_votados');?></h5>
									<?php foreach($articulos_votados as $votado):?>
										<div class="art_relacionado">						
											<div>
												<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$votado->url_seo_articulo); ?>"><?php echo $votado->titulo; ?></a>
											</div>								
										</div>
									<?php endforeach; ?>
								</article>
								<article>
									<h5><?php echo $this->lang->line('blog_categorias');?></h5>
									<?php foreach($categorias as $cat){?>
										<div>
											<a href="<?php echo site_url($this->uri->segment('1').'/blog-categoria/'.$cat->id_categoria); ?>">
												<span class="label-right"><?php echo $cat->categoria; ?></span>
											</a>
										</div>
									<?php }?>
								</article>
								<article id="etiquetas-fav">
									<h5><?php echo $this->lang->line('blog_etiquetas');?></h5>
									<?php foreach($etiquetas_favoritas as $favorita):?>
										<div>
											<?php $cadena= utf8_decode($favorita->etiqueta);
											$cadena = str_replace(' ', '-', $cadena);
											$cadena = str_replace('?', '', $cadena);
											$cadena = str_replace('+', '', $cadena);
											$cadena = str_replace(':', '', $cadena);
											$cadena = str_replace('??', '', $cadena);
											$cadena = str_replace('`', '', $cadena);
											$cadena = str_replace('!', '', $cadena);
											$cadena = str_replace('¿', '', $cadena);
											$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
											$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
											$cadena = strtr($cadena, utf8_decode($originales), $modificadas);?>
											<a href="<?php echo site_url($this->uri->segment('1').'/blog-articulos/'.$favorita->id_etiqueta.'/'.$cadena); ?>">
												<span class="label-right"><?php echo $favorita->etiqueta.' ('.$favorita->repeticiones.')'; ?></span>
											</a>
										</div>
									<?php endforeach; ?>
								</article>
							</div>
						</section>
					</div>
					<div class="fondo-blog hidden-sm hidden-md hidden-lg">	
						<section class="col-md-9">
							<article>
								<div class="rowblog">
									<div class="">
										<?php if(count($articulos)!=0): ?>
											<?php $primero = TRUE; ?>
											<?php 
												$total=count($articulos); 
												$num_paginas=$total/4;
												$contador=$cont_pag=0;
												$num_pagina=1;
												$maximo=4;
												?>
												<input type="hidden" id="por_pagina" value="4">
												<input type="hidden" id="maximo" value="<?php echo $maximo;?>">
											<?php foreach ($articulos as $art): ?>
												<div class="articulo-blog <?php echo ($primero == TRUE) ? '' : 'borde-articulo';?>">
													<div class="substr-articulo">
														<div class="titulo-blog">
															<?php $segments = array('blog', $art->url_seo_articulo);?>
															<h3><a href="<?php echo site_url($segments); ?>"><?php echo $art->titulo; ?></a></h3>
														</div>
														<div class="descripcion-corta">
															<?php echo nl2br($art->descripcion).' <a href="'.site_url($segments).'"> <b>'.$this->lang->line('blog_seguir_leyendo').'</b></a>';?>
														</div>
														<?php if ($art->img_articulo != ''): ?>
															<div class="text-center">
																<img src="<?php echo base_url('uploads/general/img/blog/1/'.$art->id_idioma.'/'.$art->img_articulo);?>" class="img-responsive" alt="<?php echo $art->titulo; ?>" title="<?php echo $art->titulo; ?>"/>
															</div>
															<p></p>
														<?php endif; ?>
														
													</div>		
												</div>
												<?php $contador++;?>
												<?php if(($contador % 4)==0) $num_pagina++;?>
												<?php $primero = FALSE;
											endforeach;?>
											<?php if($num_paginas>1):?>
												<div class="col-md-12">
													<ul class="pagination centrado">
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
									<h5><?php echo $this->lang->line('blog_mas_vistos');?></h5>
									<?php foreach($articulos_populares as $popular):?>
										<div class="art_relacionado">
																		
												<div>
													<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$popular->url_seo_articulo); ?>"><?php echo $popular->titulo; ?></a>
												</div>								
											
										</div>
									<?php endforeach; ?>
								</article>
							<!-- Artículos más votados -->
								<article>
									<h5><?php echo $this->lang->line('blog_mas_votados');?></h5>
									<?php foreach($articulos_votados as $votado):?>
										<div class="art_relacionado">						
											<div>
												<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$votado->url_seo_articulo); ?>"><?php echo $votado->titulo; ?></a>
											</div>								
										</div>
									<?php endforeach; ?>
								</article>
								<article>
									<h5><?php echo $this->lang->line('blog_categorias');?></h5>
									<?php foreach($categorias as $cat){?>
										<div>
											<a href="<?php echo site_url($this->uri->segment('1').'/blog-categoria/'.$cat->id_categoria); ?>">
												<span class="label-right"><?php echo $cat->categoria; ?></span>
											</a>
										</div>
									<?php }?>
								</article>
								<article id="etiquetas-fav">
									<h5><?php echo $this->lang->line('blog_etiquetas');?></h5>
									<?php foreach($etiquetas_favoritas as $favorita):?>
										<div>
											<?php $cadena= utf8_decode($favorita->etiqueta);
											$cadena = str_replace(' ', '-', $cadena);
											$cadena = str_replace('?', '', $cadena);
											$cadena = str_replace('+', '', $cadena);
											$cadena = str_replace(':', '', $cadena);
											$cadena = str_replace('??', '', $cadena);
											$cadena = str_replace('`', '', $cadena);
											$cadena = str_replace('!', '', $cadena);
											$cadena = str_replace('¿', '', $cadena);
											$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
											$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
											$cadena = strtr($cadena, utf8_decode($originales), $modificadas);?>
											<a href="<?php echo site_url($this->uri->segment('1').'/blog-articulos/'.$favorita->id_etiqueta.'/'.$cadena); ?>">
												<span class="label-right"><?php echo $favorita->etiqueta.' ('.$favorita->repeticiones.')'; ?></span>
											</a>
										</div>
									<?php endforeach; ?>
								</article>
							</div>
						</section>
					</div>
				<?php elseif ($it->id_tipo_bloque == 4):?>
					<div class="col-md-12">
						<div class="mapa"><?php echo $it->texto->contenido;?></div>
					</div>
				<?php endif;?>
			<?php endforeach; ?>
			<?php if($seccion->tipo_seccion == 4){?>
				<div class="col-sm-12 margin-top-20">
					<?php echo form_open('',array('class'=>'form-horizontal')); ?>
					<div class="col-sm-6">
						<div class="form-group margin-right-0">
								<?php echo form_input($nombre); ?>
								<span><?php echo form_error('nombre'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
								<?php echo form_input($email); ?>
								<span><?php echo form_error('email'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
							<?php echo form_input($mensaje); ?>
							<span><?php echo form_error('mensaje'); ?></span>
							<p></p>
						</div>
						<div class="form-group row">
							<?php echo form_submit(array('name'=>'submit_cat','value'=>'Enviar','class'=>'btn-contacto')); ?>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group margin-left-0">
								<?php echo form_input($empresa); ?>
								<span><?php echo form_error('empresa'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-left-0">
								<?php echo form_input($telefono); ?>
								<span><?php echo form_error('telefono'); ?></span>
								<p></p>	
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
			<?php }?>
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
<input type="hidden" id="site_url" value="<?php echo site_url();?>" />
<input type="hidden" id="site_idioma" value="<?php echo $this->uri->segment(1);?>" />
