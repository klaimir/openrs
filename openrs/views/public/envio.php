<?php if($idioma_actual->id_idioma == 1){
                		$mensaje = 'Mensaje enviado correctamente.';
                		$mensaje2 = '<br>Serás redirigido en breve';
                	}elseif($idioma_actual->id_idioma == 53){
                		$mensaje = 'Message sent successfully.';
                		$mensaje2 = '<br>You will be redirected shortly';
                	}elseif($idioma_actual->id_idioma == 64){
                		$mensaje = 'Message envoyé correctement.';
                		$mensaje2 = '<br>Vous allez être redirigé bientôt';
                	}elseif($idioma_actual->id_idioma == 72){
                		$mensaje = 'Nachricht gesendet korrekt.';
                		$mensaje2 = '<br>Sie werden in Kürze weitergeleitet';
                	}?>
<script>
function redireccionarPagina() {
	window.location = "<?php echo site_url($this->uri->segment('1').'/'.$nseccion);?>";
}
setTimeout("redireccionarPagina()", 4000);
</script>
<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 centrado">
			<h2><?php echo $mensaje;?></h2>
			<h4><?php echo $mensaje2;?></h4>
		</div>
	</div>
</div>