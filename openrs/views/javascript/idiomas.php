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
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					location : location
		     	}, function(data) {
		     		window.location.href = '<?php echo site_url();?>'+data;
	            });
			}else{
				$.post("<?php echo site_url('idioma/cambiar_idioma'); ?>", {
					id : id,
					id_actual : id_actual,
					'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
					location : location
		     	}, function(data) {
		     		window.location.href = '<?php echo site_url();?>'+data;
	            });	
			}
		});
	});
</script>