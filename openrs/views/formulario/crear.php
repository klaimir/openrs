<?php // Form fields configuration
	$this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 page-header">
			<h1><?php echo (($nuevo==true)? $this->lang->line('cms_crear') : $this->lang->line('cms_editar')).' '.$nombre.' '.(($nuevo==true)?'':$editando);?></h1>
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
							<?php foreach($inputs as $it): ?>
								<?php if(!$it['fijo']){?>
									<?php if(isset($elementos[$idioma->id_idioma]) && isset($elementos[$idioma->id_idioma]->$it['form_group']['name'])){?>
										<?php $it['form_group']['value'] = $elementos[$idioma->id_idioma]->$it['form_group']['name'];?>
									<?php }else{?>
										<?php $it['form_group']['value'] = '';?>
									<?php }?>
									<?php $it['form_group']['name'] = $it['form_group']['name']."_".$idioma->id_idioma;?>
									<?php $it['form_group']['id'] = $it['form_group']['id']."_".$idioma->id_idioma;?>
									<?php $this->load->view('bootstrap/form_input',$it);?>
								<?php }?>
							<?php endforeach;?>
						</div>
					<?php }?>
					<?php foreach($inputs as $it): ?>
						<?php if($it['fijo']){?>
							<?php $it['form_group']['name'] = $it['form_group']['name'];?>
							<?php $it['form_group']['id'] = $it['form_group']['id'];?>
							<?php $this->load->view('bootstrap/form_input',$it);?>
						<?php } ?>
					<?php endforeach;?>
				</div>
                                    
                                <div class="clearfix form-actions">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-info">
                                            <i class="ace-icon fa fa-save bigger-110"></i>
                                            <?php echo $this->lang->line('cms_guardar');?>
                                        </button>
                                        <button class="btn" type="reset">
                                            <i class="ace-icon fa fa-undo bigger-110"></i>
                                            Reset
                                        </button>
                                    </div>
                                </div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>