<?php header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>

<html lang="<?php echo $this->uri->segment(1);?>">

<head>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo (isset($meta_description)) ? $meta_description : $this->lang->line('login_meta_descripcion').' - '.$config->nombre;?>">
	<meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : $this->lang->line('login_meta_keywords').' - '.$config->nombre;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo (isset($title)) ? $title : $config->nombre; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('img/favicon.png'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/generic.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/js-image-slider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datepicker2.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap-datetimepicker.min.css">
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
	
	<!--[if !IE 7]>
		<style type="text/css">
			#wrap {display:table;height:100%}
		</style>
	<![endif]-->
	
	<!--[if lt IE 9]>
		<script src="<?php echo base_url('dist/html5shiv.js');?>"></script>
	<![endif]-->
</head>

<body>
	
	<div id="wrap">
		<div id="main">
			<header id="header">
				<?php echo $header ?>
			</header>
			<div id="content-admin">
				<?php echo $content;?>
			</div>
		</div>
	</div>

	<!-- Javascript placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery-ui-1.10-3-custom.min.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.cookie.js"></script>
	<script src="<?php echo base_url(); ?>js/global.js"></script>
	<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
	<?php $this->load->view('javascript/ckeditor');?>
	<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>	
	<script src="<?php echo base_url(); ?>js/moment.js"></script>
	<script src="<?php echo base_url(); ?>js/es.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
</body>
</html>
