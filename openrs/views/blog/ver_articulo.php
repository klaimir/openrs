<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-danger pull-left">', '</div>');
	
	$contenido2=array(
			'name'=>'contenido2',
			'id'=>'contenido2',
			'label' => $this->lang->line('blog_comentario'),
			'class'=>'form-control border-radius-8',
			'value'=>set_value('contenido2',isset($comentario->contenido) ? $comentario->contenido : ''),
			'rows'=>'3',
			'required' => 'required',
	);
	$email=array(
			'name'=>'email',
			'id'=>'email',
			'label'=>$this->lang->line('blog_email'),
			'class'=>'form-control border-radius-8',
			'value'=>set_value('email',isset($comentario->email) ? $comentario->email : ''),
			'help' => form_error('email'),
			'required' => 'required',
	);
	$nick=array(
			'name'=>'nick',
			'id'=>'nick',
			'label'=>$this->lang->line('blog_nick'),
			'class'=>'form-control border-radius-8',
			'value'=>set_value('nick',isset($comentario->nick) ? $comentario->nick : ''),
			'help' => form_error('nick'),
			'required' => 'required',
	);?>
<div class="container-fluid">
	<div class="row">
		<div class="inicio-seccion hidden-xs"></div>
		<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
		<?php foreach ($bloques as $it):
			if ($it->id_tipo_bloque == 2):?>
				<?php if($it->carrusel_general->tipo_carrusel == 1):?>
					<div id="carousel-<?php echo $it->id_bloque;?>" class="carousel slide" data-ride="carousel">						  				  
						<div class="carousel-inner">
							<?php foreach ($it->carrusel as $car):?>
								<div class="item <?php echo ($car->prioridad == 1) ? "active" : ""; ?>">
								  	<img src="<?php echo base_url()."img/carrusel/".$idioma_actual->id_idioma.'/'.$car->imagen; ?>" title="<?php echo $car->titulo_seo; ?>" alt="<?php echo $car->titulo_seo; ?>">
								  	<div class="carousel-caption hidden-xs">
										<h2><?php echo $car->titulo_carrusel; ?></h2>
										<h2><?php echo $car->texto_carrusel; ?></h2>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif;?>
			<?php endif;?>
		<?php endforeach;?>
		<div class="panel-servicios">
			<div>
				<div class="container">
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<h2 class="tit-panel-servicios"><?php echo lang('blog_texto_panel_servicios'); ?></h2>
					<p class="menu-servicios"><?php echo lang('blog_texto_menu_servicios'); ?></p>
				</div>
			</div>
		</div>
		<div class="fondo-blog col-sm-12 hidden-xs">
			<section class="col-sm-9">
				<article>
				<div class="rowblog">
					<div class="contenido-articulo">
						<?php if ($articulo->img_articulo != ''): ?>
							<div class="imagen-blog">
								<img class="img-responsive" src="<?php echo base_url('uploads/general/img/blog/1/'.$articulo->id_idioma.'/'.$articulo->img_articulo);?>" alt="<?php echo $articulo->titulo; ?>" title="<?php echo $articulo->titulo; ?>"/>
							</div>
						<?php endif; ?>
						<div class="titulo-blog titulo-articulo">
							<h1><?php echo $articulo->titulo?></h1>
						</div>
						<div class="descripcion-corta">
							<?php echo $articulo->contenido; ?>
						</div>
					</div>
					<!--  REDES SOCIALES  -->
					<div class="megusta">
						<div class="row">
							<div class="col-md-2 red1 hidden-xs">
								<!-- Google + -->
								<!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->
								<div class="g-plusone"></div>
								
								<!-- Inserta esta etiqueta después de la última etiqueta de Botón +1. -->
								<script type="text/javascript">
								  window.___gcfg = {lang: '<?php echo $this->uri->segment('1');?>'};
								
								  (function() {
								    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								    po.src = 'https://apis.google.com/js/platform.js';
								    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								  })();
								</script>
							</div>
							<div class="col-md-2 hidden-sm hidden-md hidden-lg">
								<!-- Google + -->
								<!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->
								<div class="g-plusone"></div>
								
								<!-- Inserta esta etiqueta después de la última etiqueta de Botón +1. -->
								<script type="text/javascript">
								  window.___gcfg = {lang: '<?php echo $this->uri->segment('1');?>'};
								
								  (function() {
								    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								    po.src = 'https://apis.google.com/js/platform.js';
								    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								  })();
								</script>
							</div>
							<div class="col-sm-2">
								<!-- Twitter -->
								<a href="https://twitter.com/share" class="twitter-share-button" data-lang="<?php echo $this->uri->segment('1');?>"><?php echo $this->lang->line('blog_twittear');?></a>
							</div>
							<div class="col-sm-4">	
								<!-- Facebook -->
								<div class="fb-share-button" data-href="<?php echo site_url('blog/'.$articulo->url_seo_articulo);?>" data-layout="button_count"></div>
							</div>
							<div class="col-sm-2">
								<a class="btn btn-small btn-default btn-votar" href="<?php echo site_url($this->uri->segment('1').'/blog-votar/'.$articulo->id); ?>"><i class="icon-white icon-ok"></i><?php echo $this->lang->line('blog_votar');?></a>
							</div>
						</div>
					</div>
					<!-- ETIQUETAS -->
					<div class="preentrada-blog">
						<?php echo $this->lang->line('blog_etiquetas');?>: 
						<?php foreach($etiquetas as $etiq): ?>
								<?php $cadenac= utf8_decode($etiq->etiqueta);
								$cadenac = str_replace(' ', '-', $cadenac);
								$cadenac = str_replace('?', '', $cadenac);
								$cadenac = str_replace('+', '', $cadenac);
								$cadenac = str_replace(':', '', $cadenac);
								$cadenac = str_replace('??', '', $cadenac);
								$cadenac = str_replace('`', '', $cadenac);
								$cadenac = str_replace('!', '', $cadenac);
								$cadenac = str_replace('¿', '', $cadenac);
								$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
								$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
								$cadencac = strtr($cadenac, utf8_decode($originales), $modificadas);?>
							<span class="label label-default"><?php echo '<a href="'.site_url($this->uri->segment('1')."/blog-articulos/".$etiq->id_etiqueta).'/'.$cadenac.'">'.$etiq->etiqueta.'</a>'; ?></span>
						<?php endforeach; ?>
						
					</div>
					<!-- ENLACES A ANTERIOR Y SIGUIENTE -->
					<p></p>
					<div class="row">
						<div>
							<?php if ($articulo_prev):?>
							<div class="nextprev">
								<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$articulo_prev[0]->url_seo_articulo); ?>" rel="prev"><?php echo '<< '.$articulo_prev[0]->titulo; ?></a>
							</div>
							<?php endif; ?>
							<div class="separador-blog hidden-xs">|</div>
							<?php if ($articulo_next):?>
							<div class="nextprev">
								<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$articulo_next[0]->url_seo_articulo); ?>" rel="next"><?php echo $articulo_next[0]->titulo.' >>'; ?></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<!--  Artículos relacionados -->
					<div>
						<h5><?php echo $this->lang->line('blog_articulos_relacionados');?></h5>
						<div class="row">
						<?php foreach($articulos_recientes as $reciente):?>
							<?php if($reciente->titulo && $reciente->descripcion && $reciente->img_articulo_mini){?>
								<div class="col-sm-2">
									<div class="art-rel-down">
										<div>
											<figure class="text-center">
												<img src="<?php echo base_url('uploads/general/img/blogmini/1/'.$reciente->id_idioma.'/'.$reciente->img_articulo_mini);?>" alt="<?php echo $reciente->titulo; ?>" title="<?php echo $reciente->titulo; ?>"/>
											</figure>
										</div>
										<div class="text-center">
											<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$reciente->url_seo_articulo); ?>"><?php echo $reciente->titulo; ?></a>
										</div>
										<div>
											<p><?php echo substr($reciente->descripcion, 0, 100);?>...</p>
										</div>
									</div>
								</div>
							<?php }?>
						<?php endforeach; ?>
						</div>
					</div>
					<div class="comentarios">
						<h5><?php echo $this->lang->line('blog_escribe_comentario');?></h5>
						<?php echo form_open('',array('class'=>'','id'=>'frmContacto')); ?>
							<?php $this->load->view('bootstrap/form_control_group',$email); ?>
							<?php $this->load->view('bootstrap/form_control_group',$nick); ?>
							<div class="control-group">
                                                                <div class="col-md-2 fuente-comentario">
                                                                    <label class="control-label pull-right" for="comentario"><?php echo $this->lang->line('blog_comentario');?></label>
                                                                </div>
								<div class="col-md-10">
									<?php echo form_textarea($contenido2); ?>
									<span><?php echo form_error('contenido2'); ?></span>
									<p></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-3 col-md-offset-2">
									<button class="g-recaptcha btn enviar border-radius-8" data-sitekey="<?php echo $this->session->userdata('recaptcha_site_key'); ?>" data-callback="onSubmit"><?php echo $this->lang->line('blog_enviar');?></button>
								</div>
							</div>
						<?php echo form_close(); ?>
						<h5><?php echo $this->lang->line('blog_comentarios');?></h5>
						<?php if(count($comentarios) == 0):?>
							<div class="well border-radius-8"><?php echo $this->lang->line('blog_no_hay_comentarios');?></div>
						<?php else: ?>
							<?php foreach($comentarios as $coment):?>
								<div class="comentario">
									<div>
										<strong><?php echo $coment->nick; ?></strong>
									</div>
									<div><?php echo '<span class="indice-comentario">#'.$coment->num_mensaje_articulo.'</span> '.nl2br($coment->contenido);?></div>
									<div class="fecha-comentario">
										<div class="pull-right">
											<?php echo date("d/m/Y - <b>H:i:s</b>", strtotime($coment->creado)); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
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
					<div class="titulo-blog titulo-articulo">
						<h3><?php echo $articulo->titulo?></h3>
					</div>
					<div class="preentrada-blog">
							<?php setlocale(LC_ALL,"es_ES");?>
							<?php echo $this->lang->line('blog_autor')." ".$autor." ".date(" d/m/Y", strtotime($articulo->creado));?>				
					</div>
					<div class="contenido-articulo">
						<?php if ($articulo->img_articulo != ''): ?>
							<div class="text-center imagen-blog">
								<img class="img-responsive" src="<?php echo base_url('uploads/general/img/blog/1/'.$articulo->id_idioma.'/'.$articulo->img_articulo);?>" alt="<?php echo $articulo->titulo; ?>" title="<?php echo $articulo->titulo; ?>"/>
							</div>
						<?php endif; ?>
							<div class="descripcion-corta">
								<?php echo $articulo->contenido; ?>
							</div>
					</div>
					<!--  REDES SOCIALES  -->
					<div class="megusta">
						<div class="row">
							<div class="col-md-2">
								<!-- Google + -->
								<!-- Inserta esta etiqueta donde quieras que aparezca Botón +1. -->
								<div class="g-plusone"></div>
								
								<!-- Inserta esta etiqueta después de la última etiqueta de Botón +1. -->
								<script type="text/javascript">
								  window.___gcfg = {lang: '<?php echo $this->uri->segment('1');?>'};
								
								  (function() {
								    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
								    po.src = 'https://apis.google.com/js/platform.js';
								    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
								  })();
								</script>
							</div>
							<div class="col-md-2">
								<!-- Twitter -->
								<a href="https://twitter.com/share" class="twitter-share-button" data-lang="<?php echo $this->uri->segment('1');?>"><?php echo $this->lang->line('blog_twittear');?></a>
							</div>
							<div class="col-md-4">	
								<!-- Facebook -->
								<div class="fb-share-button" data-href="<?php echo site_url($this->uri->segment('1').'/blog/'.$articulo->url_seo_articulo);?>" data-layout="button_count"></div>
							</div>
							<div class="col-md-2">
								<a class="btn btn-small btn-default btn-votar" href="<?php echo site_url($this->uri->segment('1').'/blog-votar/'.$articulo->id); ?>"><i class="icon-white icon-ok"></i><?php echo $this->lang->line('blog_votar');?></a>
							</div>
						</div>
					</div>
					<!-- ETIQUETAS -->
					<div class="preentrada-blog">
						<?php echo $this->lang->line('blog_etiquetas');?>: 
						<?php foreach($etiquetas as $etiq): ?>
							<?php $cadenac= utf8_decode($etiq->etiqueta);
								$cadenac = str_replace(' ', '-', $cadenac);
								$cadenac = str_replace('?', '', $cadenac);
								$cadenac = str_replace('+', '', $cadenac);
								$cadenac = str_replace(':', '', $cadenac);
								$cadenac = str_replace('??', '', $cadenac);
								$cadenac = str_replace('`', '', $cadenac);
								$cadenac = str_replace('!', '', $cadenac);
								$cadenac = str_replace('¿', '', $cadenac);
								$originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
								$modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
								$cadencac = strtr($cadenac, utf8_decode($originales), $modificadas);?>
							<span class="label label-default"><?php echo '<a href="'.site_url($this->uri->segment('1')."/blog-articulos/".$etiq->id_etiqueta).'/'.$cadenac.'">'.$etiq->etiqueta.'</a>'; ?></span>
						<?php endforeach; ?>
						
					</div>
					<!-- ENLACES A ANTERIOR Y SIGUIENTE -->
					<p></p>
					<div class="row">
						<div class="col-md-4">
							<?php if ($articulo_prev):?>
							<div class="nextprev">
								<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$articulo_prev[0]->url_seo_articulo); ?>" rel="prev"><b><?php echo '<< '.$articulo_prev[0]->titulo; ?></b></a>
							</div>
							<?php endif; ?>
						</div>
						<div class="col-md-4 col-md-offset-4">
							<?php if ($articulo_next):?>
							<div class="nextprev">
								<a class ="pull-right" href="<?php echo site_url($this->uri->segment('1').'/blog/'.$articulo_next[0]->url_seo_articulo); ?>" rel="next"><b><?php echo $articulo_next[0]->titulo.' >>'; ?></b></a>
							</div>
							<?php endif; ?>
						</div>
					</div>
					<!--  Artículos relacionados -->
					<div>
						<h3 class="text-center"><?php echo $this->lang->line('blog_articulos_relacionados');?></h3>
						<div class="row">
						<?php foreach($articulos_recientes as $reciente):?>
							<?php if($reciente->titulo && $reciente->descripcion && $reciente->img_articulo_mini){?>
								<div class="col-md-2">
									<div class="art-rel-down">
										<div>
											<figure class="text-center">
												<img src="<?php echo base_url('img/blogmini/1/'.$reciente->id_idioma.'/'.$reciente->img_articulo_mini);?>" alt="<?php echo $reciente->titulo; ?>" title="<?php echo $reciente->titulo; ?>"/>
											</figure>
										</div>
										<div class="text-center">
											<a href="<?php echo site_url($this->uri->segment('1').'/blog/'.$reciente->url_seo_articulo); ?>"><?php echo $reciente->titulo; ?></a>
										</div>
										<div>
											<p><?php echo substr($reciente->descripcion, 0, 100);?>...</p>
										</div>
									</div>
								</div>
							<?php }?>
						<?php endforeach; ?>
						</div>
					</div>
					<div class="comentarios">
						<h3><?php echo $this->lang->line('blog_escribe_comentario');?></h3>
						<?php echo form_open('',array('class'=>'','id'=>'frmContactomv')); ?>
							<?php $this->load->view('bootstrap/form_control_group',$email); ?>
							<?php $this->load->view('bootstrap/form_control_group',$nick); ?>
							<div class="control-group">
								<div class="col-md-2">
									<?php echo form_label($this->lang->line('blog_comentario'),'contenido2',array('class'=>'control-label pull-right')); ?>
								</div>
								<div class="col-md-10">
									<?php echo form_textarea($contenido2); ?>
									<span><?php echo form_error('contenido2'); ?></span>
									<p></p>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-2 col-sm-offset-2">
									<button class="g-recaptcha btn enviar border-radius-8" data-sitekey="<?php echo $this->session->userdata('recaptcha_site_key'); ?>" data-callback="onSubmitmv"><?php echo $this->lang->line('blog_enviar');?></button>
								</div>
							</div>
						<?php echo form_close(); ?>
						<h3><?php echo $this->lang->line('blog_comentarios');?></h3>
						<?php if(count($comentarios) == 0):?>
							<div class="well"><?php echo $this->lang->line('blog_no_hay_comentarios');?></div>
						<?php else: ?>
							<?php foreach($comentarios as $coment):?>
								<div class="comentario">
									<div>
										<strong><?php echo $coment->nick; ?></strong>
									</div>
									<div><?php echo '<span class="indice-comentario">#'.$coment->num_mensaje_articulo.'</span> '.nl2br($coment->contenido);?></div>
									<div class="fecha-comentario">
										<div class="pull-right">
											<?php echo date("d/m/Y - <b>H:i:s</b>", strtotime($coment->creado)); ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
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
	</div>
</div>

