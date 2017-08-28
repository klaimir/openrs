<?php // Form fields configuration
    $this->form_validation->set_error_delimiters('<div class="alert alert-warning" role="alert">', '</div>');
?>
<div class="container-fluid">
    <div class="row">
	<div class="col-sm-12">
            <a href="<?php echo site_url('page/listar_bloques/'.$seccion->url_seo);?>" class="btn btn-success"><span class="glyphicon glyphicon-upload"></span> <?php echo $seccion->titulo?></a>
	</div>
	<div class="col-sm-12">
            <ul class="nav nav-pills nav-justified">
		<li role="presentation" ><a href="<?php echo site_url('page/crear_bloque/'.$seccion->url_seo.'/'.$caracteristicas->idbloque_inmuebles);?>"><?php echo $this->lang->line('cms_bloques_paso1');?></a></li>
                <li role="presentation" class="active"><a><?php echo $this->lang->line('cms_bloques_paso2');?></a></li>
            </ul>
	</div>
	<div class="col-sm-12">
            <h2><?php echo $this->lang->line('cms_datos_inmuebles');?></h2>
	</div>
    </div>
    <div class="row">
	<div class="col-sm-12">
            <?php echo form_open('',array('class'=>'form-horizontal')); ?>
		<div class="form-group">
                    <div class="col-sm-2">
			<?php echo form_label($this->lang->line('cms_inmuebles_tipo'),'tipo_inmuebles',array('class'=>'control-label pull-right')); ?>
                    </div>
                    <div class="col-sm-2">
			<select name="tipo_inmuebles" class="form-control">
                            <option>Selecciona tipo</option>
                            <option value="1" <?php echo ($caracteristicas && $caracteristicas->tipo == 1) ? 'selected' : '';?>>Destacados</option>
                            <option value="2" <?php echo ($caracteristicas && $caracteristicas->tipo == 2) ? 'selected' : '';?>>Ofertas</option>
                        </select>
			<span><?php echo form_error('tipo_inmuebles'); ?></span>
                        <p></p>
                    </div>
		</div>
		<div class="form-group">
            <div class="col-sm-2">
				<label class="control-label pull-right"><?php echo $this->lang->line('cms_inmuebles_numero');?></label>
            </div>
            <div class="col-sm-2">
                        <select name="num_inmuebles" class="form-control">
                            <option>Selecciona máximo</option>
                            <option value="3" <?php echo ($caracteristicas && $caracteristicas->num_inmuebles == 3) ? 'selected' : '';?>>3</option>
                            <option value="4" <?php echo ($caracteristicas && $caracteristicas->num_inmuebles == 4) ? 'selected' : '';?>>4</option>
                            <option value="6" <?php echo ($caracteristicas && $caracteristicas->num_inmuebles == 6) ? 'selected' : '';?>>6</option>
                            <option value="8" <?php echo ($caracteristicas && $caracteristicas->num_inmuebles == 8) ? 'selected' : '';?>>8</option>
                        </select>
                        <span><?php echo form_error('num_inmuebles'); ?></span>
                        <p></p>
            </div>
       	</div>
       	<div class="form-group">
            <div class="col-md-10 col-md-offset-2">
				<?php echo form_submit(array('name'=>'submit_inmuebles','value'=>$this->lang->line('cms_guardar'),'class'=>'btn btn-default')); ?>
            </div>
		</div>
        <?php echo form_close(); ?>	
	</div>
    </div>
</div>