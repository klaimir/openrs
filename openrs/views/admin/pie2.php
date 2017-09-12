<script>
function formulario(form, idioma){
	var opc;
	if(form == "f1"){
		//sacamos el valor del select de dicho formulario
		opc = document.f1.col[document.f1.col.selectedIndex].value;
		if(opc == 1 || opc == 0){
			$('#grupo1_redes').fadeOut(500);
			$('#grupo1_contenido').fadeOut(500);
		}else if (opc == 2){ 
			$('#grupo1_contenido').fadeOut(1);
			$('#grupo1_redes').fadeIn(500);
		} else if(opc == 3){
			$('#grupo1_redes').fadeOut(1);
			$('#grupo1_contenido').fadeIn(500);
		}
	}else if(form == "f2"){
		//sacamos el valor del select de dicho formulario
		opc = document.f2.col[document.f2.col.selectedIndex].value;
		if(opc == 1 || opc == 0){
			$('#grupo2_redes').fadeOut(500);
			$('#grupo2_contenido').fadeOut(500);
		}else if (opc == 2){ 
			$('#grupo2_contenido').fadeOut(1);
			$('#grupo2_redes').fadeIn(500);
		}else if(opc == 3){
			$('#grupo2_redes').fadeOut(1);
			$('#grupo2_contenido').fadeIn(500);
		}
	}else if(form == "f3"){
		//sacamos el valor del select de dicho formulario
		opc = document.f3.col[document.f3.col.selectedIndex].value;
		if(opc == 1 || opc == 0){
			$('#grupo3_redes').fadeOut(500);
			$('#grupo3_contenido').fadeOut(500);
		}else if (opc == 2){ 
			$('#grupo3_contenido').fadeOut(1);
			$('#grupo3_redes').fadeIn(500);
		}else if(opc == 3){
			$('#grupo3_redes').fadeOut(1);
			$('#grupo3_contenido').fadeIn(500);
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
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option <?php echo (isset($opc_col1) && $opc_col1->id_opc == $opc->id_opc) ? 'selected' : '';?> value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col1)){?>
				<div id="grupo1_redes" <?php echo ($opc_col1->id_opc == 2) ? '' : 'style="display:none"';?>>
					<?php if($opc_col1->id_opc == 2){?>
						<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</a>
						<input class="form-control" type="text" name="facebook" value="<?php echo isset($config->facebook) ? $config->facebook :'';?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</a>
						<input class="form-control" type="text" name="twitter" value="<?php echo isset($config->twitter) ? $config->twitter : '';?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</a>
						<input class="form-control" type="text" name="google" value="<?php echo isset($config->google) ? $config->google : '';?>"></input>
										
						<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
						<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</a>
						<input class="form-control" type="text" name="vimeo" value="<?php echo isset($config->vimeo) ? $config->vimeo : '';?>"></input>
					<?php }?>
				</div>
				<div id="grupo1_contenido" <?php echo ($opc_col1->id_opc == 3) ? '' : 'style="display:none"';?>>
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<li class="<?php echo $idioma->id_idioma == $idioma_actual->id_idioma ? 'active' : '';?>"><a href="#tab1_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<div class="tab-pane <?php echo ($idioma->id_idioma == $idioma_actual->id_idioma) ? 'active' : '';?>" id="tab1_<?php echo $idioma->id_idioma;?>">
								<div class="row">
									<?php echo form_hidden('idiomas[]', $idioma->id_idioma);?>
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenidoe_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php echo $this->ckeditor->editor('contenidoe_'.$idioma->id_idioma, isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenidoe_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
							</div><?php //cierre tab-pane ?>	
						<?php } //cierre foreach?>
					</div> <?php //cierre tab-content?>
				</div>
			<?php }?>				
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
        <div class="row">
            <div class="col-xs-12">
                <div class="separacion-col pull-right">
                    <?php echo form_button($atrib);
                    echo form_close();?>
                </div>
            </div>
        </div>
        <div class="space-10"></div>
	
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f2','class'=>'form-horizontal'));?>
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo form_label($this->lang->line('admin_col_2'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-sm-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f2','<?php echo $idioma_actual->id_idioma;?>')">
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option <?php echo (isset($opc_col2) && $opc_col2->id_opc == $opc->id_opc) ? 'selected' : '';?> value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col2)){?>
				<div id="grupo2_redes" <?php echo ($opc_col2->id_opc == 2) ? '' : 'style="display:none"';?>>
					<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="facebook" value="<?php echo isset($config->facebook) ? $config->facebook :'';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="twitter" value="<?php echo isset($config->twitter) ? $config->twitter : '';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="google" value="<?php echo isset($config->google) ? $config->google : '';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="vimeo" value="<?php echo isset($config->vimeo) ? $config->vimeo : '';?>"></input>
				</div>
				<div id="grupo2_contenido" <?php echo ($opc_col2->id_opc == 3) ? '' : 'style="display:none"';?>>
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<li class="<?php $idioma->id_idioma == $idioma_actual->id_idioma ? 'active' : '';?>"><a href="#tab2_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<div class="tab-pane <?php echo $idioma->id_idioma == $idioma_actual->id_idioma ? 'active' : '';?>" id="tab2_<?php echo $idioma->id_idioma;?>">
								<?php echo form_hidden('idiomas[]', $idioma->id_idioma);?>
								<div class="row">
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido2e_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php echo $this->ckeditor->editor('contenido2e_'.$idioma->id_idioma, isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenido2e_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
							</div><?php //cierre tab-pane ?>	
						<?php } //cierre foreach?>
					</div> <?php //cierre tab-content?>
				</div>
			<?php }?>
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
	<div class="row">
            <div class="col-xs-12">
                <div class="separacion-col pull-right">
                    <?php echo form_button($atrib);
                    echo form_close();?>
                </div>
            </div>
        </div>
        <div class="space-10"></div>
                        
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f3','class'=>'form-horizontal'));?>
	<div class="form-group">
		<div class="col-sm-2">
			<?php echo form_label($this->lang->line('admin_col_3'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-sm-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f3','<?php echo $idioma_actual->id_idioma;?>')">
				<option value="0">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option <?php echo (isset($opc_col3) && $opc_col3->id_opc == $opc->id_opc) ? 'selected' : '';?> value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<?php if(isset($opc_col3)){?>
				<div id="grupo3_redes" <?php echo ($opc_col3->id_opc == 2) ? '' : 'style="display:none"';?>>
					<?php echo form_label($this->lang->line('cliente_facebook'),'facebook',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/facebook'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="facebook" value="<?php echo isset($config->facebook) ? $config->facebook : '';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_twitter'),'twitter',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/twitter'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="twitter" value="<?php echo isset($config->twitter) ? $config->twitter : '';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_google'),'google',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/google'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="google" value="<?php echo isset($config->google) ? $config->google : '';?>"></input>
									
					<?php echo form_label($this->lang->line('cliente_vimeo'),'vimeo',array('class'=>'control-label'));?>
					<a href="<?php echo site_url('admin/limpiar_red/vimeo'); ?>" class="btn btn-danger pull-right" title="<?php echo $this->lang->line('cms_eliminar');?>">Eliminar</span></a>
					<input class="form-control" type="text" name="vimeo" value="<?php echo isset($config->vimeo) ? $config->vimeo : '';?>"></input>
				</div>
				<div id="grupo3_contenido" <?php echo ($opc_col3->id_opc == 3) ? '' : 'style="display:none"';?>>
					<ul class="nav nav-tabs">
						<?php foreach($cargar_idiomas as $idioma){ ?>
							<li class="<?php echo $idioma->id_idioma == $idioma_actual->id_idioma ? 'active' : ''?>"><a href="#tab3_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
						<?php }?>
					</ul>
					<div class="tab-content">
						<?php foreach($cargar_idiomas as $idioma){?>
							<div class="tab-pane <?php echo $idioma->id_idioma == $idioma_actual->id_idioma ? 'active' : '';?>" id="tab3_<?php echo $idioma->id_idioma;?>">
								<div class="row">
									<?php echo form_hidden('idiomas[]', $idioma->id_idioma);?>
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido3e_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php //echo form_textarea($contenido); ?>
										<?php echo $this->ckeditor->editor('contenido3e_'.$idioma->id_idioma, isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : '', $config_mini);?>
										<span><?php echo form_error('contenido3e_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>
								</div>
							</div><?php //cierre tab-pane ?>	
						<?php } //cierre foreach?>
					</div> <?php //cierre tab-content?>
				</div>
			<?php }?>
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
	<div class="row">
            <div class="col-xs-12">
                <div class="separacion-col pull-right">
                    <?php echo form_button($atrib);
                    echo form_close();?>
                </div>
            </div>
        </div>
<?php //$this->load->view('javascript/ckeditor');?>