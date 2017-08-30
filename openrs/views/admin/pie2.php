<script>
function formulario(form, idioma){
	var opc;
	if(form == "f1"){
		//sacamos el valor del select de dicho formulario
		opc = document.f1.col[document.f1.col.selectedIndex].value;
		alert(opc);
		$('#grupo1').fadeOut(1);
		if(opc == 1 || opc == 0){
			$('#contenido1').fadeOut(500);
			$('#redes1').fadeOut(500);
		}else if (opc == 2){ 
			$('#contenido1').fadeOut(1);
			$('#redes1').fadeIn(500);
		} else if(opc == 3){
			$('#redes1').fadeOut(1);
			$('#contenido1').fadeIn(500);
		}
	}else if(form == "f2"){
		//sacamos el valor del select de dicho formulario
		opc = document.f2.col[document.f2.col.selectedIndex].value;
		$('#grupo2').fadeOut(1);
		if(opc == 1 || opc == 0){
			$('#contenido2').fadeOut(500);
			$('#redes2').fadeOut(500);
		}else if (opc == 2){ 
			$('#contenido2').fadeOut(1);
			$('#redes2').fadeIn(500);
		}else if(opc == 3){
			$('#redes2').fadeOut(1);
			$('#contenido2').fadeIn(500);
		}
	}else if(form == "f3"){
		//sacamos el valor del select de dicho formulario
		opc = document.f3.col[document.f3.col.selectedIndex].value;
		$('#grupo3').fadeOut(1);
		if(opc == 1 || opc == 0){
			$('#contenido3').fadeOut(500);
			$('#redes3').fadeOut(500);
		}else if (opc == 2){ 
			$('#contenido3').fadeOut(1);
			$('#redes3').fadeIn(500);
		}else if(opc == 3){
			$('#redes3').fadeOut(1);
			$('#contenido3').fadeIn(500);
		}
	}
}
</script>
<?php $config_mini = array();
		$config_mini['toolbar'] = array(
			array( 'Source', '-', 'Cut', 'Copy', 'Paste', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-', 'Link', 'Unlink', 'Anchor','-', 'Image')
		);
 
	/* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
	$config_mini['filebrowserBrowseUrl'] = base_url()."/assets/admin/ckeditor/kcfinder/browse.php";
	$config_mini['filebrowserImageBrowseUrl'] = base_url()."/assets/admin/ckeditor/kcfinder/browse.php?type=general";
	$config_mini['filebrowserUploadUrl'] = base_url()."/assets/admin/ckeditor/kcfinder/upload.php?type=files";
	$config_mini['filebrowserImageUploadUrl'] = base_url()."/assets/admin/ckeditor/kcfinder/upload.php?type=general";?>
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f1','class'=>'form-horizontal'));?>
	<div class="page-header">
    <h1>
        Gestionar pie
    </h1>
</div>
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo form_label($this->lang->line('admin_col_1'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-sm-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f1','<?php echo $idioma_actual->id_idioma;?>')">
				<?php if(isset($opc_col1)){?>
					<option value="<?php echo $opc_col1 -> id_opc; ?>"><?php echo $opc_col1 -> nombre; ?></option>
				<?php }?>
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col1)){?>
				<div id="grupo1">
					<?php if($opc_col1->id_opc == 2){?>
						<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->facebook))$valf=$config->facebook; else $valf='';?>
						<input class="form-control" type="text" name="facebook" value="<?php echo $valf;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->twitter))$valt=$config->twitter; else $valt='';?>
						<input class="form-control" type="text" name="twitter" value="<?php echo $valt;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->google))$valg=$config->google; else $valg='';?>
						<input class="form-control" type="text" name="google" value="<?php echo $valg;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->vimeo))$valk=$config->vimeo; else $valk='';?>
						<input class="form-control" type="text" name="vimeo" value="<?php echo $valk;?>"></input>
					<?php }?>
					<?php if($opc_col1->id_opc == 3){?>
						<ul class="nav nav-tabs">
							<?php foreach($cargar_idiomas as $idioma){ ?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<li class="active"><a href="#tab1_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }else{?>
									<li><a href="#tab1_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }?>
							<?php }?>
						</ul>
						<div class="tab-content">
							<?php foreach($cargar_idiomas as $idioma){?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<div class="tab-pane active" id="tab1_<?php echo $idioma->id_idioma;?>">
								<?php }else{?>
									<div class="tab-pane" id="tab1_<?php echo $idioma->id_idioma;?>">
								<?php }
									echo form_hidden('idiomas[]', $idioma->id_idioma);
									/*$contenido=array(
											'name'=>'contenido_'.$idioma->id_idioma,
											'id'=>'contenido_'.$idioma->id_idioma,
											'class'=>'form-control',
											'value'=>set_value('contenido_'.$idioma->id_idioma,isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : ''),
									);*/?>
															
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php echo $this->ckeditor->editor('contenido_'.$idioma->id_idioma, isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenido_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div><?php //cierre tab-pane ?>	
							<?php } //cierre foreach?>
						</div> <?php //cierre tab-content?>
					<?php }?>
				</div>
			<?php }?>
				<div id="redes1" style="display:none;">
					<label>Facebook</label>
					<input class="form-control" type="text" name="facebook"></input>
					<label>Twitter</label>
					<input class="form-control" type="text" name="twitter"></input>
					<label>Google+</label>
					<input class="form-control" type="text" name="google"></input>
					<label>Vimeo</label>
					<input class="form-control" type="text" name="vimeo"></input>
				</div>
				<div id="contenido1" style="display: none;">
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<li class="active"><a href="#tab1_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }else{?>
								<li><a href="#tab1_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<div class="tab-pane active" id="tab1_<?php echo $idioma->id_idioma;?>">
							<?php }else{?>
								<div class="tab-pane" id="tab1_<?php echo $idioma->id_idioma;?>">
							<?php }
								echo form_hidden('idiomas[]', $idioma->id_idioma);
								/*$contenido=array(
										'name'=>'contenido_'.$idioma->id_idioma,
										'id'=>'contenido_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('contenido_'.$idioma->id_idioma,isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : ''),
								);*/?>
														
								<div class="col-sm-12">
									<?php echo form_label($this->lang->line('blog_contenido'),'contenido_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
								</div>
								<div class="col-sm-12">
									<?php //echo form_textarea($contenido); ?>
									<?php echo $this->ckeditor->editor('contenido_'.$idioma->id_idioma, isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : '', $config_mini);?>
									<span><?php echo form_error('contenido_'.$idioma->id_idioma); ?></span>
									<p></p>
								</div>					
							</div><?php //cierre tab-pane?>
						<?php } //cierre foreach?>
					</div><?php //cierre tab-content?>
				</div><?php //cierre contenido1?>
			<?php //}?>
		</div>
	</div>
	
	<?php echo form_hidden('columna',1);?>
	<?php $atrib=array(
		'id'=>'submit',
		'name'=>'submit',
		'content'=>$this->lang->line('admin_footer_boton'),
		'type'=>'submit',
		'class'=>'btn btn-primary'
	); ?>
	<div class="separacion-col">
		<?php echo form_button($atrib);
		echo form_close();?>
	</div>
	
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f2','class'=>'form-horizontal'));?>
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo form_label($this->lang->line('admin_col_2'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-sm-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f2','<?php echo $idioma_actual->id_idioma;?>')">
				<?php if(isset($opc_col2)){?>
					<option value="<?php echo $opc_col2 -> id_opc; ?>"><?php echo $opc_col2 -> nombre; ?></option>
				<?php }?>
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col2)){?>
				<div id="grupo2">
					<?php if($opc_col2->id_opc == 2){?>
						<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->facebook))$valf=$config->facebook; else $valf='';?>
						<input class="form-control" type="text" name="facebook" value="<?php echo $valf;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->twitter))$valt=$config->twitter; else $valt='';?>
						<input class="form-control" type="text" name="twitter" value="<?php echo $valt;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->google))$valg=$config->google; else $valg='';?>
						<input class="form-control" type="text" name="google" value="<?php echo $valg;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->vimeo))$valk=$config->vimeo; else $valk='';?>
						<input class="form-control" type="text" name="vimeo" value="<?php echo $valk;?>"></input>
					<?php }?>
					<?php if($opc_col2->id_opc == 3){?>
						<ul class="nav nav-tabs">
							<?php foreach($cargar_idiomas as $idioma){ ?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<li class="active"><a href="#tab2_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }else{?>
									<li><a href="#tab2_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }?>
							<?php }?>
						</ul>
						<div class="tab-content">
							<?php foreach($cargar_idiomas as $idioma){?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<div class="tab-pane active" id="tab2_<?php echo $idioma->id_idioma;?>">
								<?php }else{?>
									<div class="tab-pane" id="tab2_<?php echo $idioma->id_idioma;?>">
								<?php }
									echo form_hidden('idiomas[]', $idioma->id_idioma);
									/*$contenido=array(
											'name'=>'contenido2e_'.$idioma->id_idioma,
											'id'=>'contenido2e_'.$idioma->id_idioma,
											'class'=>'form-control',
											'value'=>set_value('contenido2e_'.$idioma->id_idioma,isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : ''),
									);*/?>
															
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido2_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php //echo form_textarea($contenido); ?>
										<?php echo $this->ckeditor->editor('contenido2_'.$idioma->id_idioma, isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenido2e_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div><?php //cierre tab-pane ?>	
							<?php } //cierre foreach?>
						</div> <?php //cierre tab-content?>
					<?php }?>
				</div>
			<?php }?>
				<div id="redes2" style="display:none;">
					<label>Facebook</label>
					<input class="form-control" type="text" name="facebook"></input>
					<label>Twitter</label>
					<input class="form-control" type="text" name="twitter"></input>
					<label>Google+</label>
					<input class="form-control" type="text" name="google"></input>
					<label>Vimeo</label>
					<input class="form-control" type="text" name="vimeo"></input>
				</div>
				<div id="contenido2" style="display: none;">
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<li class="active"><a href="#tab2_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }else{?>
								<li><a href="#tab2_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<div class="tab-pane active" id="tab2_<?php echo $idioma->id_idioma;?>">
							<?php }else{?>
								<div class="tab-pane" id="tab2_<?php echo $idioma->id_idioma;?>">
							<?php }
								echo form_hidden('idiomas[]', $idioma->id_idioma);
								$contenido=array(
										'name'=>'contenido2_'.$idioma->id_idioma,
										'id'=>'contenido2_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('contenido2_'.$idioma->id_idioma,isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : ''),
								);?>
														
								<div class="col-sm-12">
									<?php echo form_label($this->lang->line('blog_contenido'),'contenido2_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
								</div>
								<div class="col-sm-12">
									<?php //echo form_textarea($contenido); ?>
									<?php echo $this->ckeditor->editor('contenido2_'.$idioma->id_idioma, isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : '', $config_mini);?>
									<span><?php echo form_error('contenido2_'.$idioma->id_idioma); ?></span>
									<p></p>
								</div>					
							</div><?php //cierre tab-pane?>
						<?php } //cierre foreach?>
					</div><?php //cierre tab-content?>
				</div><?php //cierre contenido1?>
			<?php //}?>
		</div>
	</div>
	
	<?php echo form_hidden('columna',2);?>
	<?php $atrib=array(
		'id'=>'submit',
		'name'=>'submit',
		'content'=>$this->lang->line('admin_footer_boton'),
		'type'=>'submit',
		'class'=>'btn btn-primary'
	); ?>
	<div class="separacion-col">
		<?php echo form_button($atrib);
		echo form_close();?>
	</div>
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f3','class'=>'form-horizontal'));?>
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo form_label($this->lang->line('admin_col_3'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-sm-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f3','<?php echo $idioma_actual->id_idioma;?>')">
				<?php if(isset($opc_col3)){?>
					<option value="<?php echo $opc_col3 -> id_opc; ?>"><?php echo $opc_col3 -> nombre; ?></option>
				<?php }?>
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col3)){?>
				<div id="grupo2">
					<?php if($opc_col3->id_opc == 2){?>
						<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->facebook))$valf=$config->facebook; else $valf='';?>
						<input class="form-control" type="text" name="facebook" value="<?php echo $valf;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->twitter))$valt=$config->twitter; else $valt='';?>
						<input class="form-control" type="text" name="twitter" value="<?php echo $valt;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->google))$valg=$config->google; else $valg='';?>
						<input class="form-control" type="text" name="google" value="<?php echo $valg;?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>"><span class="glyphicon glyphicon-trash"></span></a>
						<?php if(isset($config->vimeo))$valk=$config->vimeo; else $valk='';?>
						<input class="form-control" type="text" name="vimeo" value="<?php echo $valk;?>"></input>
					<?php }?>
					<?php if($opc_col3->id_opc == 3){?>
						<ul class="nav nav-tabs">
							<?php foreach($cargar_idiomas as $idioma){ ?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<li class="active"><a href="#tab3_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }else{?>
									<li><a href="#tab3_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
								<?php }?>
							<?php }?>
						</ul>
						<div class="tab-content">
							<?php foreach($cargar_idiomas as $idioma){?>
								<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
									<div class="tab-pane active" id="tab3_<?php echo $idioma->id_idioma;?>">
								<?php }else{?>
									<div class="tab-pane" id="tab3_<?php echo $idioma->id_idioma;?>">
								<?php }
									echo form_hidden('idiomas[]', $idioma->id_idioma);
									/*$contenido=array(
											'name'=>'contenido3e_'.$idioma->id_idioma,
											'id'=>'contenido3e_'.$idioma->id_idioma,
											'class'=>'form-control',
											'value'=>set_value('contenido3e_'.$idioma->id_idioma,isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : ''),
									);*/?>
															
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido3e_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php //echo form_textarea($contenido); ?>
										<?php echo $this->ckeditor->editor('contenido3e_'.$idioma->id_idioma, isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenido3e_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div><?php //cierre tab-pane ?>	
							<?php } //cierre foreach?>
						</div> <?php //cierre tab-content?>
					<?php }?>
				</div>
			<?php }?>
				<div id="redes3" style="display:none;">
					<label>Facebook</label>
					<input class="form-control" type="text" name="facebook"></input>
					<label>Twitter</label>
					<input class="form-control" type="text" name="twitter"></input>
					<label>Google+</label>
					<input class="form-control" type="text" name="google"></input>
					<label>Vimeo</label>
					<input class="form-control" type="text" name="vimeo"></input>
				</div>
				<div id="contenido3" style="display: none;">
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<li class="active"><a href="#tab3_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }else{?>
								<li><a href="#tab3_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
							<?php }?>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
								<div class="tab-pane active" id="tab3_<?php echo $idioma->id_idioma;?>">
							<?php }else{?>
								<div class="tab-pane" id="tab3_<?php echo $idioma->id_idioma;?>">
							<?php }
								echo form_hidden('idiomas[]', $idioma->id_idioma);
								/*$contenido=array(
										'name'=>'contenido3_'.$idioma->id_idioma,
										'id'=>'contenido3_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('contenido3_'.$idioma->id_idioma,isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : ''),
								);*/?>
														
								<div class="col-sm-12">
									<?php echo form_label($this->lang->line('blog_contenido'),'contenido3_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
								</div>
								<div class="col-sm-12">
									<?php //echo form_textarea($contenido); ?>
									<?php echo $this->ckeditor->editor('contenido3_'.$idioma->id_idioma, isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : '', $config_mini);?>
									<span><?php echo form_error('contenido3_'.$idioma->id_idioma); ?></span>
									<p></p>
								</div>					
							</div><?php //cierre tab-pane?>
						<?php } //cierre foreach?>
					</div><?php //cierre tab-content?>
				</div><?php //cierre contenido3?>
			<?php //}?>
		</div>
	</div>
	
	<?php echo form_hidden('columna',3);?>
	<?php $atrib=array(
		'id'=>'submit',
		'name'=>'submit',
		'content'=>$this->lang->line('admin_footer_boton'),
		'type'=>'submit',
		'class'=>'btn btn-primary'
	); ?>
	<div class="separacion-col">
		<?php echo form_button($atrib);
		echo form_close();?>
	</div>
<?php //$this->load->view('javascript/ckeditor');?>