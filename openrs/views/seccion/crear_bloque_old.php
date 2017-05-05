<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-error pull-right">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2><?php echo $title;?></h2>
			<p></p>
		</div>
		<div class="col-md-12">
			<?php echo form_open_multipart('',array('class'=>'form-horizontal', 'role'=>'form')); ?>
				<?php foreach($inputs as $it):?>
					<?php $this->load->view('bootstrap/form_input',$it);?>
				<?php endforeach;?>
				<div class="bloque-texto">
					<h3>Agregar texto del bloque</h3>
					<?php foreach($inputs_texto as $itexto):?>
						<?php $this->load->view('bootstrap/form_input',$itexto);?>
					<?php endforeach;?>
				</div>
				<div class="bloque-carrusel">	
					<h3>Seleccionar tipo de galería</h3>
					<?php foreach($inputs_carrusel as $icarrusel):?>
						<?php $this->load->view('bootstrap/form_input',$icarrusel);?>
					<?php endforeach;?>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default">Guardar</button>
				    </div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
			