<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.cambio_idioma').click(function(){
			var id = $(this).data("id");
			var id_actual = $(this).data("id_actual");
			var location = window.location.href;
			var cookie = $(this).data("cookie");
			if(cookie){
				$.post("<?php echo site_url('idioma/cambiar_idioma/1'); ?>", {
					id : id,
					id_actual : id_actual,
					location : location
		     	}, function(data) {
		     		window.location.href = data;
	            });
			}else{
				$.post("<?php echo site_url('idioma/cambiar_idioma'); ?>", {
					id : id,
					id_actual : id_actual,
					location : location
		     	}, function(data) {
		     		window.location.href = data;
	            });	
			}
		});
	});
</script>