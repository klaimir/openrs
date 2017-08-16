<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!DOCTYPE html>

<html lang="<?php echo $this->uri->segment(1);?>">

<head>
	<meta charset="utf-8">
	<meta name="description" content="<?php echo (isset($meta_description)) ? $meta_description : $this->lang->line('login_meta_descripcion').' - '.$config->nombre;?>">
	<meta name="keywords" content="<?php echo (isset($meta_keywords)) ? $meta_keywords : $this->lang->line('login_meta_keywords').' - '.$config->nombre;?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo (isset($title)) ? $title : $config->nombre; ?></title>
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo $title.' - '.$config->nombre;?>" />
    <meta property="og:description" content="<?php echo substr($meta_description,0,170);?>" />
    <meta property="og:image" content="<?php echo (isset($meta_imagen)) ? $meta_imagen : '';?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/public/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/public/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/public/css/datepicker2.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/public/css/font-awesome.min.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
	
	<!-- Javascript placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url(); ?>assets/public/js/jquery-1.10.2.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/jquery-ui-1.10.3-custom.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/jquery.cookie.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/global.js"></script>
	<!-- <script src="<?php echo base_url(); ?>assets/public/ckeditor/ckeditor.js"></script>-->
	<script src="<?php echo base_url(); ?>assets/public/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/moment.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/es.js"></script>
	<script src="<?php echo base_url(); ?>assets/public/js/bootstrap-datetimepicker.min.js"></script>
	<!--[if !IE 7]>
		<style type="text/css">
			#wrap {display:table;height:100%}
		</style>
	<![endif]-->
	
	<!--[if lt IE 9]>
		<script src="<?php echo base_url('dist/html5shiv.js');?>"></script>
	<![endif]-->
        
        <?php include_once(APPPATH.'third_party/analyticstracking.php'); ?>
</head>

<body style="background-color:<?php echo $config->cfondo;?>; color:<?php echo $config->cfuentefondo;?>">
	<div id="wrap">
		<div id="main">
			<header id="header">
				<?php echo $header ?>
			</header>
			<div id="content">
				<?php echo $content_center; ?>
			</div>
		</div>
	</div>
	<footer id="footer" style="background-color:<?php echo $config->cpie;?>;border-top: 3px solid #000;">
		<?php echo $footer; ?>
	</footer>

	
</body>

</html>
