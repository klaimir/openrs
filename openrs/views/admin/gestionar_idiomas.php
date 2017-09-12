<?php $this->load->view('javascript/global');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">	
			<?php if(isset($message)): ?>
				<div class="well"><strong><?php echo $this->lang->line('admin_aviso');?></strong><br><?php echo $message;?></div><br>
			<?php endif; ?>
	    </div>
	</div>
	<div class="page-header">
    	<h1><?php echo $title; ?></h1>
	</div>
	<div class="row">
		<section class="col-md-12">
			<div class="row">
				<div class="col-md-4 col-md-offset-8">
					<a href="<?php echo site_url('admin/subir_idiomas')?>" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span> Subir idioma </a>
				</div>
			</div>
		</section>
	</div>
	<div class="row" style="margin-top:20px;">
	    <div class="col-xs-12" style="overflow-y:auto">
	        <table class="table table-striped table-bordered table-hover">
	            <thead>
	                <tr>
	                    <th>Idioma</th>
	                    <th>Seo1</th>
	                    <th>Seo2</th>
	                    <th>Activo</th>
	                    <th>Opciones</th>
	                </tr>
	            </thead>
	            <tbody>              
	            	<?php foreach ($idiomas as $idioma){ ?>
	            	<?php echo form_open('admin/modificar_idioma', array('class'=>'form-horizontal'));?>
						<?php $nombre=array(
							'name'	=> 'nombre_'.$idioma->id_idioma,
							'id'	=> 'nombre_'.$idioma->id_idioma,
							'value'	=> set_value('nombre',isset($idioma->nombre) ? $idioma->nombre : ''),
							'maxlength'	=> 50,
							'size'	=> 30,
							'class'=> 'form-control'
						);
						$nombre_seo=array(
							'name'	=> 'nombre_seo_'.$idioma->id_idioma,
							'id'	=> 'nombre_seo_'.$idioma->id_idioma,
							'value'	=> set_value('nombre_seo',isset($idioma->nombre_seo) ? $idioma->nombre_seo : ''),
							'maxlength'	=> 10,
							'size'	=> 10,
							'class'=> 'form-control'
						);
						$nombre_seo2=array(
							'name'	=> 'nombre_seo2_'.$idioma->id_idioma,
							'id'	=> 'nombre_seo2_'.$idioma->id_idioma,
							'value'	=> set_value('nombre_seo2',isset($idioma->nombre_seo2) ? $idioma->nombre_seo2 : ''),
							'maxlength'	=> 5,
							'size'	=> 10,
							'class'=> 'form-control'
						);
						$activo=array(
							'name'	=> 'activo_'.$idioma->id_idioma,
							'id'	=> 'activo_'.$idioma->id_idioma,
							'checked' =>set_value('activo',isset($idioma->activo) ? $idioma->activo : ''),
							'value' => '1'
						);?>
						<?php echo form_hidden('id_idioma', $idioma->id_idioma);?>
	                    <tr>
	                        <td><?php echo form_input($nombre); ?></td>
	                        <td><?php echo form_input($nombre_seo); ?></td>
	                        <td><?php echo form_input($nombre_seo2); ?></td>
	                        <td><?php echo form_checkbox($activo); ?></td>
	                        <td>
								<div class="action-buttons">
									<?php echo form_submit(array('name'=>'submit','value'=>$this->lang->line('admin_modificar_idioma'),'class'=>'btn btn-info'));?>
	                                <a class="btn btn-danger borrar" id="<?php echo site_url('admin/eliminar_idioma/'.$idioma->id_idioma);?>" href="#" title="Borrar">
	                                    Eliminar
	                                </a>
	                            </div>
	
							</td>                      
	                    </tr>
	                    <?php echo form_close();?>
	                <?php }?>
	            </tbody>
	        </table>
	    </div>
	</div>
</div>