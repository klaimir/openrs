<?php
//Seleccionar el formato de los mensajes de error
$this->form_validation->set_error_delimiters('<div class="alert alert-error pull-right">', '</div>');

// Primero defino los campos que voy a necesitar para el formulario
$nombre = array(
		'name'=>'nombre',
		'id'=>'nombre',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'placeholder' => 'Nombre y Apellidos'
		);
$empresa = array(
		'name'=>'empresa',
		'id'=>'empresa',
		'class'=>'form-control border-radius-8',
		'placeholder' => 'Empresa'
);
$email = array(
		'name'=>'email',
		'id'=>'email',
		'class'=>'form-control border-radius-8',
		'required' => 'required',
		'pattern' => "[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9.-]+",
		'placeholder' => 'Email'
);
$telefono = array(
		'name'=>'telefono',
		'id'=>'telefono',
		'class'=>'form-control border-radius-8',
		'placeholder' => 'Teléfono'
);
$mensaje = array(
		'name'=>'mensaje',
		'id'=>'mensaje',
		'class'=>'form-control caja-mensaje border-radius-8',
		'rows'=>4,
		'required' => 'required',
		'placeholder' => 'Mensaje'
);
?>
<div class="inicio-seccion hidden-xs"></div>
<div class="inicio-seccion-movil hidden-sm hidden-md hidden-lg"></div>

		<!--<div class="col-lg-12">-->
			<!--<h1><?php echo $seccion->titulo; ?></h1>-->
			<?php foreach ($bloques as $it):?>
				<?php if ($it->id_tipo_bloque == 1): //Bloque de texto?>
						<!-- <h3 class="titulo-bloque" style="text-align:center;color:<?php echo $it->c_titulo;?>;"><?php echo $it->titulo_bloque; ?></h3> -->
						<?php if($it->ancho == 1){?>
							<div class="container-fluid" style="background:<?php echo $it->background;?>"><?php echo $it->texto->contenido;?></div>
						<?php }elseif($it->ancho == 2){?>
							<div class="container" style="background:<?php echo $it->background;?>"><?php echo $it->texto->contenido;?></div>
						<?php }?>
				<?php elseif ($it->id_tipo_bloque == 4):?>
					<div class="col-sm-12">
						<div class="mapa"><?php echo $it->texto->contenido;?></div>
					</div>
				<?php endif;?>
			<?php endforeach; ?>
			<?php if($seccion->tipo_seccion == 4){?>
				<div class="col-sm-12 margin-top-20">
					<?php echo form_open('',array('class'=>'form-horizontal')); ?>
					<div class="col-sm-6">
						<div class="form-group margin-right-0">
								<?php echo form_input($nombre); ?>
								<span><?php echo form_error('nombre'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
								<?php echo form_input($email); ?>
								<span><?php echo form_error('email'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-right-0">
							<?php echo form_input($mensaje); ?>
							<span><?php echo form_error('mensaje'); ?></span>
							<p></p>
						</div>
						<div class="form-group row">
							<?php echo form_submit(array('name'=>'submit_cat','value'=>'Enviar','class'=>'btn-contacto')); ?>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group margin-left-0">
								<?php echo form_input($empresa); ?>
								<span><?php echo form_error('empresa'); ?></span>
								<p></p>
						</div>
						<div class="form-group margin-left-0">
								<?php echo form_input($telefono); ?>
								<span><?php echo form_error('telefono'); ?></span>
								<p></p>	
						</div>
					</div>
				<?php echo form_close(); ?>
				</div>
			<?php }?>

<input type="hidden" id="site_url" value="<?php echo site_url();?>" />
<input type="hidden" id="site_idioma" value="<?php echo $this->uri->segment(1);?>" />
