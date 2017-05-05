<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		if ($('.a_datatable').length > 0){ 
			$('.a_datatable').dataTable({
				"sDom": "<'row-fluid'<'col-md-7'l><'col-md-5'f>r>t<'row-fluid'<'col-md-6'i><'col-md-6" +
						"'p>>",
				"sPaginationType": "bootstrap",
				"iDisplayLength": 15,
				"aLengthMenu": [15, 50, 100],
				"oLanguage": {
					"sLengthMenu": "<?php echo $this->lang->line('tablas_registros_pagina');?>",
					"sInfo": "<?php echo $this->lang->line('tablas_mostrando');?>",
					"sSearch": "<?php echo $this->lang->line('tablas_filtrar');?>",
					 "oPaginate": {
						"sNext": "",
						"sPrevious": ""
					}
				}
			});
		}
		$(function () {
			  $('[data-toggle="tooltip"]').tooltip()
			})
	});
</script>