<div class="form-group"> 
    <ul class="nav nav-tabs">
            <?php foreach($idiomas_activos as $idioma) { ?>
                    <?php if($idioma->id_idioma == $this->data['session_id_idioma']){?>
                            <li class="active"><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
                    <?php }else{?>
                            <li><a href="#tab_<?php echo $idioma->id_idioma;?>" data-toggle="tab"><?php echo $idioma->nombre;?></a></li>
                    <?php }?>
            <?php }?>
    </ul>
    <div class="tab-content">
        <?php foreach($idiomas_activos as $idioma) { ?>
            <?php if($idioma->id_idioma == $this->data['session_id_idioma']){?>
                    <div class="tab-pane active" id="tab_<?php echo $idioma->id_idioma;?>">
            <?php }else{?>
                    <div class="tab-pane" id="tab_<?php echo $idioma->id_idioma;?>">
            <?php }?>
                        <div class="form-group">            
                            <?php echo label('Nombre', 'nombre_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                            <div class="col-sm-9">
                                <?php echo form_input($datos_idioma[$idioma->id_idioma], '', 'class="form-control"'); ?>
                            </div>
                        </div>
                    </div>
        <?php } ?>
    </div>
</div>

<div class="space-4"></div>
<div class="form-group">            
    <?php echo label('Descripción', 'descripcion', 'class="col-sm-3 control-label no-padding-right"'); ?>
    <div class="col-sm-9">
        <?php echo form_input($descripcion, '', 'class="form-control"'); ?>
    </div>
</div>