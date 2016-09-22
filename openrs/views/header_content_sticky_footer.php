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
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('img/favicon/apple-icon-57x57.png');?>">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('img/favicon/apple-icon-60x60.png');?>">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('img/favicon/apple-icon-72x72.png');?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('img/favicon/apple-icon-76x76.png');?>">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('img/favicon/apple-icon-114x114.png');?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('img/favicon/apple-icon-120x120.png');?>">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('img/favicon/apple-icon-144x144.png');?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('img/favicon/apple-icon-152x152.png');?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('img/favicon/apple-icon-180x180.png');?>">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('img/favicon/android-icon-192x192.png');?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('img/favicon/favicon-32x32.png');?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('img/favicon/favicon-96x96.png');?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('img/favicon/favicon-16x16.png');?>">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/generic.css"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/jquery.fancybox.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/js-image-slider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/slider.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/datepicker2.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway:700' rel='stylesheet' type='text/css'>
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

<body style="background-color:<?php echo $config->cfondo;?>; color:<?php echo $config->cfuentefondo;?>">
	<!-- Para boton de facebook -->
	 <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
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
	<footer id="footer" style="background-color:<?php echo $config->cpie;?>;border-top: 3px solid #ff5959;">
		<?php echo $footer; ?>
	</footer>

	<!-- Javascript placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url(); ?>js/jquery-1.10.2.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery-ui-1.10-3-custom.min.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.cookie.js"></script>
	<script src="<?php echo base_url(); ?>js/global.js"></script>
	<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.ui.touch-punch.min.js"></script>
	<?php $this->load->view('javascript/accordion');?>
	<script src="<?php echo base_url(); ?>js/jquery.easing.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.zaccordion.min.js"></script>
	<script src="<?php echo base_url(); ?>js/moment.js"></script>
	<script src="<?php echo base_url(); ?>js/es.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap-datetimepicker.min.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.bxslider.min.js"></script>
	<!-- <script src="<?php echo base_url(); ?>js/openmodal.js"></script>
	<script src="<?php echo base_url(); ?>js/openmodaleditor.js"></script>
	<script src="<?php echo base_url();?>js/jquery.MultiFile.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/js-image-slider.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/thumbnail-slider.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>js/jquery.fancybox.js?v=2.1.5" type="text/javascript"></script> -->
    
    <!--  <script language="javascript" type="text/javascript">
			jQuery(document).ready(function() {
				$('.datepicker').datepicker();
			});
	</script>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-44873061-2', 'restupon.com');
	  ga('send', 'pageview');
	
	</script> -->
</body>

</html>
