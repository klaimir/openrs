<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Starter Template - Materialize</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/public/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url();?>assets/public/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?php echo base_url();?>assets/public/js/materialize.js"></script>
  <script src="<?php echo base_url();?>assets/public/js/init.js"></script>
</head>
<body>
  <!-- <nav class="light-blue lighten-1" role="navigation"> 
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Logo</a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>-->
  <?php /*
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Starter Template</h1>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
      </div>
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>
      <br><br>

    </div>
  </div>
   * 
   */
  ?>
<?php if($config->cabecera_fija == 1){?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color:<?php echo $config->ccabecera;?>;">
<?php }else{?>
<div class="navbar navbar-inverse navbar-suelto" role="navigation" style="background-color:<?php echo $config->ccabecera;?>;">
<?php }?>
  	<div class="container">
	    <div class="col-sm-3 cabecera-logo hidden-xs">
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'img/preferencias/'.$config->user_id.'/'.$config->imagen_thumb; ?>" class="img-responsive" alt="<?php echo $config->nombre;?>" title="<?php echo $config->nombre;?>"/></a>
		</div>
	    <?php /*if($config_template['menu_izquierda']==='template') { ?>
	    <!-- Page Layout here -->
	    <div class="row">
	
	      <div class="col s12 m3 l2">
	        <!-- Grey navigation panel -->
	        <ul>
	            <li><a href="#">Grey Link1</a></li>
	            <li><a href="#">Grey Link2</a></li>
	        </ul>
	      </div>
	
	      <div class="col s12 m9 l10">
	    <?php } */?>
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
								<a href="<?php echo site_url('sseccion/seccion/'.$sh->url_seo);?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $sh->titulo; ?></a>
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
						<?php endforeach; ?>
						<?php if($this->ion_auth->logged_in()){?>
							<?php /*if($this->simple_sessions->es_usuario()){?>
								<li class="elemento-header">
									<a href="<?php echo site_url('usuario-mi-cuenta'); ?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $this->lang->line('admin_mi_cuenta');?></a>
								</li>	
							<?php }*/?>
							<li>
								<a href="<?php echo site_url('logout'); ?>" class="menu-der" style="color:<?php echo $config->cfuentecabecera;?>"><span class="glyphicon glyphicon-off"></span></a>
							</li>
						<?php }else{?>
							<li>
								<a href="<?php echo site_url('login'); ?>" class="menu-der" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo "LOGIN";?></a>
							</li>
							<!-- <li>
								<a href="<?php echo site_url('registro');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo "Regístrate."; ?></a>
							</li> -->
						<?php }?>
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
						<?php endforeach;
						if($seccion == 'mi_cuenta'){ ?>
							<li class="elemento-header active">
								<a href="<?php echo site_url('usuario-mi-cuenta'); ?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $this->lang->line('admin_mi_cuenta');?></a>
							</li>
							<li>
								<a href="<?php echo site_url('logout'); ?>" class="menu-der" style="color:<?php echo $config->cfuentecabecera;?>"><span class="glyphicon glyphicon-off"></span></a>
							</li>				
						<?php }elseif($seccion == 'error'){ ?>
							<?php if($this->ion_auth->logged_in()){?>
								<?php /*if($this->simple_sessions->es_usuario()){?>
									<li class="elemento-header">
										<a href="<?php echo site_url('usuario-mi-cuenta'); ?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo $this->lang->line('admin_mi_cuenta');?></a>
									</li>
								<?php }*/?>
								<li>
									<a href="<?php echo site_url('logout'); ?>" class="menu-der" style="color:<?php echo $config->cfuentecabecera;?>"><span class="glyphicon glyphicon-off"></span></a>
								</li>
							<?php }else{?>
								<li>
									<a href="<?php echo site_url('login'); ?>" class="menu-der" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo "LOGIN";?></a>
								</li>
								<!-- <li>
									<a href="<?php echo site_url('registro');?>" style="color:<?php echo $config->cfuentecabecera;?>"><?php echo "Regístrate."; ?></a>
								</li> -->
							<?php }?>
						<?php }?>	
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
			<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url().'img/preferencias/'.$config->user_id.'/'.$config->imagen_thumb; ?>" class="img-responsive" alt="<?php echo $config->nombre;?>" title="<?php echo $config->nombre;?>"/></a>
		</div>
	</div>
</div>
					
        