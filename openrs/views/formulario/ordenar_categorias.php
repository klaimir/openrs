<?php $this->load->view('javascript/global');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<h2><?php echo $title; ?></h2>
		</div>
		<div class="col-md-8">			
	    	<ul id="sortable">
	    		<?php $orden = '';?>
		    	<?php foreach($ordenar as $it): ?>
		    		<?php $orden = $orden.''.$it->id.';'?>
		        	<li id="<?php echo $it->id; ?>" class="ui-state-default"><span class="glyphicon glyphicon-sort pull-right"></span><?php echo $it->nombre_cat;?></li>
		      	<?php endforeach; ?>
	      	</ul>
	      	<?php echo form_open('',array('class'=>'form-horizontal')); ?>
	      	<input type="hidden" name="input_orden" id="input_orden" value="<?php echo $orden; ?>" />
	      	<div class="control-group">
				<div class="controls">
					<?php echo form_submit(array('name'=>'submit','value'=>$this->lang->line('cms_guardar'),'class'=>'btn btn-default','id'=>'guardar_orden')); ?>
				</div>
			</div>
	      	<?php echo form_close();?>
		</div>
	</div>
</div>