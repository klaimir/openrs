<div class="form-group">            
    <?php echo label('Título', 'titulo', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($titulo, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('Dirección web (URL)', 'url', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($url, '', 'class="form-control" onchange="mark_modified_field();"'); ?>
        <small class="blue">Introduzca la url completa (Por ejemplo https://www.youtube.com/watch?v=hnkQNAhSZiU o http://www.idealista.com)</small>
    </div>
</div>
<div class="form-group">            
    <?php echo label('Publicado', 'publicado', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_checkbox('publicado', '1', $publicado_checked, 'class="checkbox" onchange="mark_modified_field();"'); ?>
    </div>
</div>
<div class="form-group">            
    <?php echo label('Video Youtube', 'youtube', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_checkbox('youtube', '1', $youtube_checked, 'class="checkbox" onchange="mark_modified_field();"'); ?>
    </div>
</div>
