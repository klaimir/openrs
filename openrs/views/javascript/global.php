<script>
	$(document).ready(function() {
		$('.borrar').click(function(){
			$('.btn-borrar').empty();
			$('.btn-borrar').append('<a href="'+$(this).attr('id')+'" class="btn btn-primary">'+"<?php echo $this->lang->line('modal_boton_confirmar');?>"+'</a>');
			$('#modalBorrar').modal();
		});
		//Ordenar secciones
		$('#guardar_orden').click(function(){
			var $ids = '';
			$('#sortable li').each(function(){
				$ids = $ids+''+this.id+';';
			});
			$('#input_orden').val($ids);
		});
	});
    $(function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
    });
</script>

<div class="modal fade" id="modalBorrar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
	   <div class="modal-header">
	     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	     <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('modal_titulo_borrado');?></h4>
	   </div>
	   <div class="modal-body">
	      <?php echo $this->lang->line('modal_texto_borrado');?>
	   </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('modal_boton_cancelar');?></button>
	        <span class="btn-borrar"><?php echo $this->lang->line('modal_boton_confirmar');?></span>
	      </div>
    </div>
  </div>
</div>