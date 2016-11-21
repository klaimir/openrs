<script>
	<?php //if(isset($sec) && ($sec == "-3" || $sec == "6" || $sec == "-2")){ ?>
		<?php foreach($cargar_idiomas as $idioma){?>
			CKEDITOR.replace('contenido_<?php echo $idioma->id_idioma;?>');
		<?php }?>
	<?php //}?>
</script>
<script>
	<?php //if(isset($sec) && ($sec == "-3" || $sec == "6" || $sec == "-2")){ ?>
		<?php foreach($cargar_idiomas as $idioma){?>
			CKEDITOR.replace('contenido2_<?php echo $idioma->id_idioma;?>');
		<?php }?>
	<?php //}?>
</script>
<script>
	<?php //if(isset($sec) && ($sec == "-3" || $sec == "6" || $sec == "-2")){ ?>
		<?php foreach($cargar_idiomas as $idioma){?>
			CKEDITOR.replace('contenido3_<?php echo $idioma->id_idioma;?>');
		<?php }?>
	<?php //}?>
</script>
<script>
	<?php //if(isset($sec) && ($sec == "-3" || $sec == "6" || $sec == "-2")){ ?>
		<?php foreach($cargar_idiomas as $idioma){?>
			CKEDITOR.replace('contenido4_<?php echo $idioma->id_idioma;?>');
		<?php }?>
	<?php //}?>
</script>