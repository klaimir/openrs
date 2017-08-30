<?php $this->load->view('javascript/idiomas');?>
<?php if($config->cabecera_fija == 1){?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:<?php echo $config->ccabecera;?>; border-bottom:2px solid <?php echo $config->cbordecabecera;?>;">
<?php }else{?>
<div class="navbar navbar-inverse navbar-suelto" role="navigation" style="background-color:<?php echo $config->ccabecera;?>;border-bottom:2px solid <?php echo $config->cbordecabecera;?>;">
<?php }?>
  	<div class="container">
	    <div class="col-sm-3 cabecera-logo hidden-xs">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'uploads/general/img/preferencias/'.$config->imagen; ?>" class="img-responsive" alt="<?php echo $config->nombre;?>" title="<?php echo $config->nombre;?>"/></a>
		</div>
	    <div class="col-md-9 menu-desplegable hidden-xs">
			<div class="menu-nav hidden-xs" style="background-color:<?php echo $config->ccabecera;?>">
				<div class="menu">
				<ul>
					<?php $tienda=false;?>
					<?php if($seccion != 'admin' && $seccion != 'login' && $seccion !='mi_cuenta' && $seccion != 'error'){
						foreach ($secciones_header as $sh):
							if($sh->id == $seccion->id){ ?>
							<li class="active">
							<?php }else{?>
							<li>
							<?php }?>
					
							<?php if($sh->tipo_seccion == 1):?>
								<a href="<?php echo site_url($this->uri->segment('1').'/seccion/seccion/'.$sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 2): ?>
								<a href="<?php echo site_url($this->uri->segment('1').'/'.$sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 3): ?>
							<?php if($idioma_actual->id_idioma == '1'){?>
								<a href="<?php echo site_url($this->uri->segment('1').'/blog-articulos');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php }elseif($idioma_actual->id_idioma == '53'){?>
								<a href="<?php echo site_url($this->uri->segment('1').'/blog-news');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php }?>
							<?php elseif ($sh->tipo_seccion == 4): ?>
								<a href="<?php echo site_url($this->uri->segment('1').'/'.$sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 5): ?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?> <span class="caret"></span></a>
						          <ul class="dropdown-menu" role="menu">
							          <?php foreach($subsecciones_header as $ssh){?>
							            <li><a href="<?php echo site_url($ssh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $ssh->titulo; ?></a></li>
							            <li class="divider"></li>
							          <?php }?>
						          </ul>
						    <?php elseif ($sh->tipo_seccion == 6): ?>
						    	<?php $tienda=true;?>
						    	<?php if($categorias_principales == NULL){?>
										<a href="<?php echo site_url('tienda');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
								<?php }else{?>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?> <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<?php foreach($categorias_principales as $catp){?>
													<li class="categoria-principal"><a href="<?php echo site_url('tienda/'.$catp->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $catp->nombre_familia; ?></a></li>
											<?php }?>
										</ul>
								<?php }?>
							<?php endif; ?>
							</li>
						<?php endforeach; ?>
					 <?php }else{
						foreach ($secciones_header as $sh):?>
							<li>
							<?php if($sh->tipo_seccion == 1):?>
								<a href="<?php echo site_url('seccion/seccion/'.$sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 2): ?>
								<a href="<?php echo site_url($sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 3): ?>
								<a href="<?php echo site_url('blog-articulos');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 4): ?>
								<a href="<?php echo site_url($sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
							<?php elseif ($sh->tipo_seccion == 5): ?>
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?> <span class="caret"></span></a>
						          <ul class="dropdown-menu" role="menu">
							          <?php foreach($subsecciones_header as $ssh){?>
							            <li><a href="<?php echo site_url($ssh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $ssh->titulo; ?></a></li>
							            <li class="divider"></li>
							          <?php }?>
						          </ul>
						    <?php elseif ($sh->tipo_seccion == 6): ?>
						    	<?php $tienda=true;?>
								<?php if($categorias_principales == NULL){?>
										<a href="<?php echo site_url('tienda');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
								<?php }else{?>
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?> <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<?php foreach($categorias_principales as $catp){?>
													<li class="categoria-principal"><a href="<?php echo site_url('tienda/'.$catp->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $catp->nombre_familia; ?></a></li>
											<?php }?>
										</ul>
								<?php }?>
							<?php endif; ?>
							</li>
						<?php endforeach;?>
					<?php }?>
					<?php if(count($cargar_idiomas) > 1){?>
					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo strtoupper($idioma_actual->nombre_seo2);?> <b class="caret"></b></a>
						<ul class="dropdown-menu">		
							<?php foreach($cargar_idiomas as $cargar_idioma){?>
								<li><a tabindex="-1" data-id_actual="<?php echo $idioma_actual->id_idioma;?>" data-id="<?php echo $cargar_idioma->id_idioma;?>" class="cambio_idioma" style="cursor:pointer"><?php echo strtoupper($cargar_idioma->nombre_seo2);?></a> </li>
							<?php }?>			
						</ul>
					</li>
					<?php }?>
				</ul>
				</div>
			</div>
		</div>
	    <div class="menu-mv hidden-sm hidden-md hidden-lg col-xs-6">
			<div class="menu_bar">
				<a href="#" class="bt-menu">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</a>
			</div>
			 
			<nav>
				<ul>
					<li></li>
				</ul>
			</nav>
		</div> 
		<div class="col-xs-9 cabecera-logo hidden-sm hidden-md hidden-lg">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'uploads/general/img/preferencias/'.$config->imagen; ?>" class="img-responsive" alt="<?php echo $config->nombre;?>" title="<?php echo $config->nombre;?>"/></a>
		</div>
	</div>
</div>
					
        