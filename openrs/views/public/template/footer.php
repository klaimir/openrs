<div class="footer-inner">
		<div class="container-fluid">
			<div class="row">
				<div class="container">
				<?php $cont=0;?>
				<?php foreach($cols_pie as $cp):?>
					<?php $cont++;?>
						<!-- <div class="col-md-4 laterales-footer hidden-xs hidden-sm"></div> -->
						<div class="col-md-<?php echo $span; ?> centrado">
						<!--  <div class="col-md-4 centrado">-->
						<?php if($cont == 1){?>
							<!--  <h5 class="tit-footer" style="color:<?php echo $config->cfuentepie;?>;border-top:1px solid <?php echo $config->cbordecabecera;?>"><?php //echo $this->lang->line('cliente_opc_footer_'.$cp->id_opc); ?></h5> -->
						<?php }?>
							<?php if($cp->id_opc == 1){?>
								<ul class="ul-footer">
								<?php foreach($menu_footer as $sec):?>
									<li>
										<?php if ($sec->tipo_seccion == 1):?>
											<a href="<?php echo site_url($this->uri->segment('1').'/seccion/seccion/'.$sec->url_seo); ?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo;?></a>
										<?php elseif ($sec->tipo_seccion == 2): ?>
											<a href="<?php echo site_url($this->uri->segment('1').'/'.$sec->url_seo);?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
										<?php elseif ($sec->tipo_seccion == 3): ?>
											<?php if($idioma_actual->id_idioma == '1'){?>
												<a href="<?php echo site_url($this->uri->segment('1').'/blog-articulos');?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
											<?php }elseif($idioma_actual->id_idioma == '53'){?>
												<a href="<?php echo site_url($this->uri->segment('1').'/blog-news');?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
											<?php }?>
										<?php elseif ($sec->tipo_seccion == 4): ?>
											<a href="<?php echo site_url($this->uri->segment('1').'/'.$sec->url_seo);?>" style="color:<?php echo $config->cfuentepie;?>"><?php echo $sec->titulo; ?></a>
										
										<?php endif; ?>
									</li>
								<?php endforeach;?>
								</ul>
							<?php }elseif($cp->id_opc == 2){?>
								<div class="row margin-top-30">
								<?php if($config->facebook != NULL){?>
									<a href="<?php echo $config->facebook;?>"><i class="fa fa-facebook-square fa-2x color-white" aria-hidden="true"></i></a>
								<?php }if($config->twitter != NULL){?>
									<a href="<?php echo $config->twitter;?>"><i class="fa fa-twitter-square fa-2x color-white" aria-hidden="true"></i></a>
								<?php }if($config->google != NULL){?>
									<a href="<?php echo $config->google;?>"><i class="fa fa-google-plus-square fa-2x color-white" aria-hidden="true"></i></a>
								<?php }if($config->vimeo != NULL){?>
									<a href="<?php echo $config->vimeo;?>"><i class="fa fa-vimeo-square fa-2x color-white" aria-hidden="true"></i></a>
								<?php }?>
								</div>
							<?php }elseif($cp->id_opc == 3){?>
								<?php if($cont == 1){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo1;?>
									</div>
								<?php }elseif($cont == 2){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo2;?>
									</div>
								<?php }elseif($cont == 3){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo3;?>
									</div>
								<?php }elseif($cont == 4){?>
									<div class="texto-pie" style="color:<?php echo $config->cfuentepie;?>">
										<?php echo $codigo4;?>
									</div>
								<?php }?>	
							<?php }?>
						</div>
						<!-- <div class="col-md-4 laterales-footer hidden-xs hidden-sm"></div> -->
				<?php endforeach;?>	
				</div>
			</div>
			
			<div class="row">
				<div class="subfooter">
					<p style="color:<?php echo $config->cfuentepie;?>"><?php echo $config->nombre.' '.date('Y'); ?>. Todos los derechos reservados</p>
				</div>
			</div>
		</div>
	</div>

<?php if(!$this->input->cookie('cookieLOPD')):?>
<div class="navbar navbar-cookies navbar-fixed-bottom">
	<div class="navbar-inner">
    	<div class="container">
    		Las cookies nos permiten ofrecer nuestros servicios. Al utilizar nuestros servicios, aceptas el uso que hacemos de las cookies.<span class="btn btn-mini btn-success aceptar-cookies">Aceptar</span><a href="<?php echo site_url('aviso-legal#cookies'); ?>"><span class="btn btn-mini">Más info</span></a>
    	</div>
    </div>
</div>
<?php endif; ?>