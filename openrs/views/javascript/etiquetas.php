<script>
	$(document).ready(function() {
		//Añadir nueva etiqueta
		$('.mas_etiqueta').click(function(){
			//A cada etiqueta le añado un id con su contenido para posteriormente ser procesada
			 var id = $(this).attr('id').split('_');
			if($('#ins_etiqueta_'+id[1]).val().length < 3){
				alert(<?php echo $this->lang->line('blog_error_etiqueta1');?>+$('#ins_etiqueta_'+id[1]).val()+<?php echo $this->lang->line('blog_error_etiqueta2');?>);
			} else if($('#ins_etiqueta_'+id[1]).val().indexOf('+') != -1){
				alert(<?php echo $this->lang->line('blog_error_etiqueta1');?>+$('#ins_etiqueta_'+id[1]).val()+<?php echo $this->lang->line('blog_error_etiqueta3');?>);
			} else {
				//Si no hay error pasamos la etiqueta a minúsculas
				$etiqueta = $('#ins_etiqueta_'+id[1]).val().toLowerCase();
				
				$('#etiquetas_'+id[1]+' ul').append('<li class="alert alert-info del_etiqueta" id="'+$etiqueta+'">'+$etiqueta+' x</li>');
				$('#ins_etiqueta_'+id[1]).val('');
			}
			$('#ins_etiqueta_'+id[1]).focus();
		});
	});
</script>