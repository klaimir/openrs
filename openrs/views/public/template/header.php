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
					
        