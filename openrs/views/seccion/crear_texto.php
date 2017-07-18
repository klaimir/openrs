<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-danger pull-right">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<a href="<?php echo site_url('page/listar_bloques/'.$seccion->url_seo);?>" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> <?php echo $seccion->titulo?></a>
		</div>
		<div class="col-md-12">
			<ul class="nav nav-pills nav-justified">
				<li role="presentation" ><a href="<?php echo site_url('page/crear_bloque/'.$seccion->url_seo.'/'.$texto->id_bloque);?>"><?php echo $this->lang->line('cms_bloques_paso1');?></a></li>
				<li role="presentation" class="active"><a><?php echo $this->lang->line('cms_bloques_paso2');?></a></li>
			</ul>
		</div>
		<div class="col-md-12">
			<h2><?php echo (($nuevo==true)?$this->lang->line('cms_crear'):$this->lang->line('cms_editar')).' '.$this->lang->line('cms_bloque_texto');?></h2>
			<p></p>
		</div>
		<div class="col-md-12">
			<?php echo form_open('',array('class'=>'form-horizontal', 'role'=>'form')); ?>
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
							<?php foreach($inputs as $it):?>
								<?php if(isset($elementos[$idioma->id_idioma]) && isset($elementos[$idioma->id_idioma]->$it['form_group']['name'])){?>
									<?php $it['form_group']['value'] = $elementos[$idioma->id_idioma]->$it['form_group']['name'];?>
								<?php }else{?>
									<?php $it['form_group']['value'] = '';?>
								<?php }?>
								<?php $it['form_group']['name'] = $it['form_group']['name']."_".$idioma->id_idioma;?>
								<?php $it['form_group']['id'] = $it['form_group']['id']."_".$idioma->id_idioma;?>
								<!--  <textarea class="ckeditor" name="html" id="html" rows="10">text</textarea>-->
								<?php
		$config_mini = array();
		$config_mini['toolbar'] = array(
			array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ,'-', 'Link', 'Unlink', 'Anchor','Image')
		);
 
	/* Y la configuración del kcfinder, la debemos poner así si estamos trabajando en local */
	$config_mini['filebrowserBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php";
	$config_mini['filebrowserImageBrowseUrl'] = base_url()."assets/admin/ckeditor/kcfinder/browse.php?type=images";
	$config_mini['filebrowserUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=files";
	$config_mini['filebrowserImageUploadUrl'] = base_url()."assets/admin/ckeditor/kcfinder/upload.php?type=images";
	$_SESSION['KCFINDER'] = array();
	$_SESSION['KCFINDER']['disabled'] = false; // Activate the uploader, Users to this page MUST be authenticated
	$_SESSION['KCFINDER']['uploadURL'] = "/uploads/".$this->ion_auth->user()->row()->id; // Based on my second folder structure
	
	
	echo $this->ckeditor->editor('contenido_'.$idioma->id_idioma, $it['form_group']['value'], $config_mini);
	?>
								<?php //$this->load->view('bootstrap/form_input',$it);?>
							<?php endforeach;?>
							</div>
						<?php }?>
					</div>
				</div>
				<div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      	<button type="submit" class="btn btn-default"><?php echo $this->lang->line('cms_guardar');?></button>
				    </div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
			