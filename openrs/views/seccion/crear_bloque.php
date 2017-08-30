<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-error pull-right">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url('page/listar_bloques/'.$seccion->url_seo);?>" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> <?php echo $seccion->titulo?></a>
		</div>
		<div class="col-md-12">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" class="active"><a><?php echo $this->lang->line('cms_bloques_paso1');?></a></li>
				<li role="presentation"><a <?php echo ($nuevo==false)?'href="'.site_url('page/editar_bloque/'.$id_bloque).'"':'';?>><?php echo $this->lang->line('cms_bloques_paso2');?></a></li>
			</ul>
		</div>
		<div class="col-md-12">
			<h2><?php echo (($nuevo==true)?$this->lang->line('cms_crear'):$this->lang->line('cms_editar')).' '.$nombre.' '.(($nuevo==true)?'':$editando);?></h2>
			<p></p>
		</div>
		<div class="col-md-12">
			<?php echo form_open_multipart('',array('class'=>'form-horizontal', 'role'=>'form')); ?>
				<ul class="nav nav-tabs">
					<?php foreach($cargar_idiomas as $idioma){ ?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<li class="active"><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }else{?>
							<li><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					<?php }?>
				</ul>
				<div class="tab-content">
					<?php foreach($cargar_idiomas as $idioma){?>
						<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
							<div class="tab-pane active" id="tab_<?php echo $idioma->id_idioma;?>">
						<?php }else{?>
							<div class="tab-pane" id="tab_<?php echo $idioma->id_idioma;?>">
						<?php }?>
								<div class="form-group">
									<div class="col-sm-2">
										<label for="titulo_bloque_<?php echo $idioma->id_idioma;?>" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_titulo')?></label>	
									</div>
								    <div class="col-sm-4">
								    	<input type="text" name="titulo_bloque_<?php echo $idioma->id_idioma;?>" value="<?php echo (isset($bloque->titulo_bloque) && $bloque->titulo_bloque) ? $bloque->titulo_bloque : '';?>" class="form-control" placeholder="Nombre del bloque">    	
								    	<p></p>    
								    </div>
								</div>
							</div>
					<?php }?>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="id_tipo_bloque" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_tipo_bloque')?></label>	
						</div>
					    <div class="col-sm-4">
					    	<select id="id_tipo_bloque" name="id_tipo_bloque" class="form-control id_tipo_bloque" <?php echo (isset($bloque->id_tipo_bloque) && $bloque->id_tipo_bloque) ? 'disabled="disabled"' : '';?>>
					    		<?php foreach($tipo_bloque as $k=>$v){?>
									<option value="<?php echo $k;?>" <?php echo (isset($bloque->id_tipo_bloque) && $bloque->id_tipo_bloque) ? 'selected="selected"' : '';?>><?php echo $v;?></option>
								<?php }?>
							</select>    	
					    	<p></p>    
						</div>
					</div>
					<?php if(!$nuevo && isset($bloque->id_tipo_bloque) && $bloque->id_tipo_bloque == 6){?>
						<div id="imagen" class="form-group">
					<?php }else{?>
						<div id="imagen" class="form-group oculto">
					<?php }?>
						<div class="col-sm-2">
							<label for="userfile" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_imagen')?></label>	
						</div>
						<div class="col-sm-4">
							<input type="file" name="userfile" class="form-control">    	
							<p></p>    
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="id_estado" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_estado');?></label>	
						</div>
					    <div class="col-sm-4">
					    	<select name="id_estado" class="form-control id_estado">
					    		<?php foreach($estado as $k=>$v){?>
									<option value="<?php echo $k;?>" <?php echo (isset($bloque->id_estado) && $bloque->id_estado == $k) ? 'selected="selected"' : '';?>><?php echo $v;?></option>
								<?php }?>
							</select>    	
					    	<p></p>    
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="background" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_background');?></label>	
						</div>
					    <div class="col-sm-1">
					    	<input type="color" name="background" value="<?php echo (isset($bloque->background) && $bloque->background) ? $bloque->background : '';?>" id="background" class="form-control input_color">    	
					    	<p></p>    
					    </div>
					</div>
					<div class="form-group">
						<div class="col-sm-2">
							<label for="c_titulo" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_color_titulo');?></label>	
						</div>
					    <div class="col-sm-1">
					    	<input type="color" name="c_titulo" value="<?php echo (isset($bloque->c_titulo) && $bloque->c_titulo) ? $bloque->c_titulo : '';?>" id="c_titulo" class="form-control input_color">    	
					    	<p></p>    
					    </div>
					</div>		
					<div class="form-group">
						<div class="col-sm-2">
							<label for="ancho" class="control-label pull-right"><?php echo $this->lang->line('cms_c_bloques_ancho');?></label>	
						</div>
					    <div class="col-sm-4">
					    	<select name="ancho" class="form-control ancho">
					    		<?php foreach($ancho as $k=>$v){?>
									<option value="<?php echo $k;?>" <?php echo (isset($bloque->ancho) && $bloque->ancho == $k) ? 'selected="selected"' : '';?>><?php echo $v;?></option>
								<?php }?>
							</select>    	
					    	<p></p>    
						</div>
					</div>
				</div>
				<input type="hidden" name="prioridad" value="<?php echo ($nuevo) ? $this->general_model->maximo('bloque','prioridad',array('id_seccion'=>$seccion->id))->prioridad+1 : $bloque->prioridad;?>">
				<input type="hidden" name="id_seccion" value="<?php echo $seccion->id;?>">
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Continuar</button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>	
<script>
$(document).ready(function(){
	$('#id_tipo_bloque').change(function(){
		var tipo = $(this).val();
		if(tipo == 6){
			$('#imagen').fadeIn(500);
		}else{
			$('#imagen').fadeOut(500);
		}
	});
});
</script>