<?php $this->load->view('javascript/global');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12 page-header">
			<h1><?php echo $this->lang->line('cms_galeria_ordenar_imagenes');?></h1>
		</div>
		<div class="col-md-8">			
	    	<ul id="sortable">
	    		<?php $orden = '';?>
		    	<?php foreach($ordenar as $it): ?>
		    		<?php $orden = $orden.''.$it->id_imagen_carrusel.';'?>
		        	<li id="<?php echo $it->id_imagen_carrusel; ?>" class="ui-state-default"><span class="glyphicon glyphicon-sort pull-right"></span><img src="<?php echo base_url('uploads/general/img/carruselmini/'.$idioma_actual->id_idioma.'/'.$it->imagen_mini);?>" /></li>
		      	<?php endforeach; ?>
	      	</ul>
	      	<?php echo form_open('',array('class'=>'form-horizontal')); ?>
	      	<input type="hidden" name="input_orden" id="input_orden" value="<?php echo $orden; ?>" />
                <div class="form-group">
                    <div class="clearfix form-actions">
                        <div class="col-md-offset-3 col-md-9">
                            <?php echo form_submit(array('name'=>'submit','value'=>$this->lang->line('cms_guardar'),'class'=>'btn btn-info','id'=>'guardar_orden')); ?>
                        </div>
                    </div>
                </div>
	      	<?php echo form_close();?>
		</div>
	</div>
</div>