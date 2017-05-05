<script>
function formulario(form, idioma){
	var opc;
	if(form == "f1"){
   		opc = document.f1.col[document.f1.col.selectedIndex].value;
   		//borramos el contenido de la capa
   		//document.getElementById("grupo1").innerHTML="";
   		//document.getElementById("formulario-t1").innerHTML="";
   		document.getElementById('grupo1').style.display = 'none';
   	   	if (opc == 2) 
   	   		document.getElementById('redes1').style.display = 'block';
   	   		//$("#redes1").append("<label>Facebook</label><input class=\"form-control\" type=\"text\" name=\"facebook\"></input><label>Twitter</label><input class=\"form-control\" type=\"text\" name=\"twitter\"></input><label>Google+</label><input class=\"form-control\" type=\"text\" name=\"google\"></input><label>Vimeo</label><input class=\"form-control\" type=\"text\" name=\"vimeo\"></input>");
   	   	else if(opc == 3)
   	   		document.getElementById('contenido1').style.display = 'block';
	   		//$("#formulario-t1").append("<input type=\"hidden\" name=\"idioma\" value=\""+idioma+"\"><textarea class=\"form-control\" name=\"contenido_1\" id=\"contenido_1\"></textarea>");   	
	}else if(form == "f2"){
		opc = document.f2.col[document.f2.col.selectedIndex].value;
		//borramos el contenido de la capa
   		//document.getElementById("grupo2").innerHTML="";
   		//document.getElementById("formulario-t2").innerHTML="";
   		document.getElementById('grupo2').style.display = 'none';
   	   	if (opc == 2) 
   	   		document.getElementById('redes2').style.display = 'block';
   	   		//$("#formulario-t2").append("<label>Facebook</label><input class=\"form-control\" type=\"text\" name=\"facebook\"></input><label>Twitter</label><input class=\"form-control\" type=\"text\" name=\"twitter\"></input><label>Google+</label><input class=\"form-control\" type=\"text\" name=\"google\"></input><label>Vimeo</label><input class=\"form-control\" type=\"text\" name=\"vimeo\"></input>");
   	   	else if(opc == 3)
   	   		document.getElementById('contenido2').style.display = 'block';
	   		//$("#formulario-t2").append("<input type=\"hidden\" name=\"idioma\" id=\"idioma\" value=\""+idioma+"\"><textarea class=\"form-control\" name=\"contenido\" id=\"contenido\"></textarea>");
   	}else if(form == "f3"){
		opc = document.f3.col[document.f3.col.selectedIndex].value;
		//borramos el contenido de la capa
   		document.getElementById("grupo3").innerHTML="";
   		document.getElementById("formulario-t3").innerHTML="";
   	   	if (opc == 2) 
   	   		$("#formulario-t3").append("<label>Facebook</label><input class=\"form-control\" type=\"text\" name=\"facebook\"></input><label>Twitter</label><input class=\"form-control\" type=\"text\" name=\"twitter\"></input><label>Google+</label><input class=\"form-control\" type=\"text\" name=\"google\"></input><label>Vimeo</label><input class=\"form-control\" type=\"text\" name=\"vimeo\"></input>");
   	   	else if(opc == 3)
	   		$("#formulario-t3").append("<input type=\"hidden\" name=\"idioma\" value=\""+idioma+"\"><textarea class=\"form-control\" name=\"contenido3_1\" id=\"contenido3_1\"></textarea>");
	}else if(form == "f4"){
		opc = document.f4.col[document.f4.col.selectedIndex].value;
		//borramos el contenido de la capa
   		document.getElementById("grupo4").innerHTML="";
   		document.getElementById("formulario-t4").innerHTML="";
   	   	if (opc == 2) 
   	   		$("#formulario-t4").append("<label>Facebook</label><input class=\"form-control\" type=\"text\" name=\"facebook\"></input><label>Twitter</label><input class=\"form-control\" type=\"text\" name=\"twitter\"></input><label>Google+</label><input class=\"form-control\" type=\"text\" name=\"google\"></input><label>Vimeo</label><input class=\"form-control\" type=\"text\" name=\"vimeo\"></input>");
   	   	else if(opc == 3)
	   		$("#formulario-t4").append("<input type=\"hidden\" name=\"idioma\" value=\""+idioma+"\"><textarea class=\"form-control\" name=\"contenido4_1\" id=\"contenido4_1\"></textarea>");
	}
}
</script>
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f1','class'=>'form-horizontal'));?>
	<div class="form-group">
		<div class="col-md-2">
			<?php echo form_label($this->lang->line('admin_col_1'),'col',array('class'=>'control-label pull-right'));?>
		</div>
		<div class="col-md-10">
			<select name="col" id="col" class="form-control" onchange="formulario('f1','<?php echo $idioma_actual->id_idioma;?>')">
				<?php if(isset($opc_col1)){?>
					<option value="<?php echo $opc_col1 -> id_opc; ?>"><?php echo $opc_col1 -> nombre; ?></option>
				<?php }?>
				<option value="vacio">Vacío</option>
				<?php foreach($opc_footer as $opc){?>
					<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
				<?php } ?>        
			</select>
			<span><?php echo form_error('col'); ?></span>
			<div id="grupo1">
				<?php if(isset($opc_col1)){?>
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
									$contenido=array(
										'name'=>'contenido_'.$idioma->id_idioma,
										'id'=>'contenido_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('contenido_'.$idioma->id_idioma,isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : ''),
									);?>
														
									<div class="col-md-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-md-12">
										<?php echo form_textarea($contenido); ?>
										<span><?php echo form_error('contenido_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>					
								</div>
							<?php }?>
							</div>
						<?php }?>
					<?php }else{?>
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
									$contenido=array(
										'name'=>'contenido_'.$idioma->id_idioma,
										'id'=>'contenido_'.$idioma->id_idioma,
										'class'=>'form-control',
										'value'=>set_value('contenido_'.$idioma->id_idioma,isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : ''),
									);?>
														
									<div class="col-sm-12">
										<?php echo form_label($this->lang->line('blog_contenido'),'contenido_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
									</div>
									<div class="col-sm-12">
										<?php echo form_textarea($contenido); ?>
										<span><?php echo form_error('contenido_'.$idioma->id_idioma); ?></span>
										<p></p>
									</div>					
								</div>
							<?php }?>
							</div>
						</div>
					<?php }?>
					</div>
					<!-- <div id="formulario-t1"></div> -->
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
		<div class="form-group separacion-col-sup">
					<div class="col-sm-2">
						<?php echo form_label($this->lang->line('admin_col_2'),'col',array('class'=>'control-label pull-right'));?>
					</div>
					<div class="col-sm-10">
						<select name="col" id="col" class="form-control" onchange="formulario('f2','<?php echo $idioma_actual->id_idioma;?>')">
							<?php if(isset($opc_col2)){?>
								<option value="<?php echo $opc_col2 -> id_opc; ?>"><?php echo $opc_col2 -> nombre; ?></option>
						    <?php }?>
					        <option value="vacio">Vacío</option>
					       	<?php foreach($opc_footer as $opc){?>
								<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
							<?php } ?>        
						</select>
						<span><?php echo form_error('col'); ?></span>
						<div id="grupo2">
							<?php if(isset($opc_col2)){?>
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
													$contenido=array(
														'name'=>'contenido2_'.$idioma->id_idioma,
														'id'=>'contenido2_'.$idioma->id_idioma,
														'class'=>'form-control',
														'value'=>set_value('contenido2_'.$idioma->id_idioma,isset($texto_footer2[$idioma->id_idioma]->contenido) ? $texto_footer2[$idioma->id_idioma]->contenido : ''),
													); echo $idioma->id_idioma.' Contenido: '.$texto_footer2[$idioma->id_idioma]->contenido;?>	
													<div class="col-md-12">
														<?php echo form_label($this->lang->line('blog_contenido'),'contenido2_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
													</div>
													<div class="col-md-12">
														<?php echo form_textarea($contenido); ?>
														<span><?php echo form_error('contenido2_'.$idioma->id_idioma); ?></span>
														<p></p>
													</div>	
												</div>
										<?php }?>
									</div>
								<?php }?>
							<?php }else{?>
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
												'value'=>set_value('contenido2_'.$idioma->id_idioma,isset($texto_footer1[$idioma->id_idioma]->contenido) ? $texto_footer1[$idioma->id_idioma]->contenido : ''),
											);?>
																
											<div class="col-sm-12">
												<?php echo form_label($this->lang->line('blog_contenido'),'contenido2_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
											</div>
											<div class="col-sm-12">
												<?php echo form_textarea($contenido); ?>
												<span><?php echo form_error('contenido2_'.$idioma->id_idioma); ?></span>
												<p></p>
											</div>					
										</div>
									<?php }?>
									</div>
								</div>
							<?php }?>
							</div>
							<!-- <div id="formulario-t2"></div>-->
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
		<div class="form-group separacion-col-sup">
						 	<div class="col-md-2">
								<?php echo form_label($this->lang->line('admin_col_3'),'col',array('class'=>'control-label pull-right'));?>
							</div>
						 	<div class="col-md-10">
						 		<select name="col" id="col" class="form-control" onchange="formulario('f3','<?php echo $idioma_actual->id_idioma;?>')">
								<?php if(isset($opc_col3)){?>
									<option value="<?php echo $opc_col3 -> id_opc; ?>"><?php echo $opc_col3 -> nombre; ?></option>
					        	<?php }?>
					        		<option value="vacio">Vacío</option>
					        	<?php 
								   	foreach($opc_footer as $opc){?>
								    	<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
								<?php } ?>        
								</select>
								<span><?php echo form_error('col'); ?></span>
								<div id="grupo3">
								<?php if(isset($opc_col3)){?>
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
														$contenido=array(
																'name'=>'contenido3_'.$idioma->id_idioma,
																'id'=>'contenido3_'.$idioma->id_idioma,
																'class'=>'form-control',
																'value'=>set_value('contenido3_'.$idioma->id_idioma,isset($texto_footer3[$idioma->id_idioma]->contenido) ? $texto_footer3[$idioma->id_idioma]->contenido : ''),
														);?>
														
															<div class="col-md-12">
																<?php echo form_label($this->lang->line('blog_contenido'),'contenido3_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
															</div>
															<div class="col-md-12">
																<?php echo form_textarea($contenido); ?>
																<span><?php echo form_error('contenido3_'.$idioma->id_idioma); ?></span>
																<p></p>
															</div>
														
													</div>
											<?php }?>
										</div>
									<?php }?>
								<?php }?>
								</div>
								<div id="formulario-t3"></div>
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
	<?php echo form_open(site_url('admin/modificarPie'), array('name'=>'f4','class'=>'form-horizontal'));?>
		<div class="form-group separacion-col-sup">
			<div class="col-sm-2">
				<?php echo form_label($this->lang->line('admin_col_4'),'col',array('class'=>'control-label pull-right'));?>
			</div>
			<div class="col-sm-10">
				<select name="col" id="col" class="form-control" onchange="formulario('f4','<?php echo $idioma_actual->id_idioma;?>')">
					<?php if(isset($opc_col4)){?>
						<option value="<?php echo $opc_col4 -> id_opc; ?>"><?php echo $opc_col4 -> nombre; ?></option>
					<?php }?>
					<option value="vacio">Vacío</option>
					<?php foreach($opc_footer as $opc){?>
						<option value="<?php echo $opc -> id_opc; ?>"><?php echo $opc -> nombre; ?></option>
					<?php } ?>        
				</select>
				<span><?php echo form_error('col'); ?></span>
				<div id="grupo4">
					<?php if(isset($opc_col4)){?>
						<?php if($opc_col4->id_opc == 2){?>
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
						<?php if($opc_col4->id_opc == 3){?>
							<ul class="nav nav-tabs">
								<?php foreach($cargar_idiomas as $idioma){ ?>
									<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
										<li class="active"><a href="#tab4_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
									<?php }else{?>
										<li><a href="#tab4_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
									<?php }?>
								<?php }?>
							</ul>
							<div class="tab-content">
								<?php foreach($cargar_idiomas as $idioma){?>
									<?php if($idioma->id_idioma == $idioma_actual->id_idioma){?>
										<div class="tab-pane active" id="tab4_<?php echo $idioma->id_idioma;?>">
									<?php }else{?>
										<div class="tab-pane" id="tab4_<?php echo $idioma->id_idioma;?>">
									<?php }
										echo form_hidden('idiomas[]', $idioma->id_idioma);
										$contenido=array(
											'name'=>'contenido4_'.$idioma->id_idioma,
											'id'=>'contenido4_'.$idioma->id_idioma,
											'class'=>'form-control',
											'value'=>set_value('contenido4_'.$idioma->id_idioma,isset($texto_footer4[$idioma->id_idioma]->contenido) ? $texto_footer4[$idioma->id_idioma]->contenido : ''),
										);?>
														
										<div class="col-md-12">
											<?php echo form_label($this->lang->line('blog_contenido'),'contenido4_'.$idioma->id_idioma,array('class'=>'control-label')); ?>
										</div>
										<div class="col-md-12">
											<?php echo form_textarea($contenido); ?>
											<span><?php echo form_error('contenido4_'.$idioma->id_idioma); ?></span>
											<p></p>
										</div>
														
									</div>
								<?php }?>
							</div>
						<?php }?>
					<?php }?>
				</div>
				<div id="formulario-t4"></div>
			</div>
	</div>
	<?php echo form_hidden('columna',4);?>
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
</div>
<?php //$this->load->view('javascript/ckeditor');?>

					