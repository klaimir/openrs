<div class="well" id="buscador">
    <?php echo form_open('inmuebles', 'class="form-horizontal" method="get"'); ?>    
    <div class="row">
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Provincias', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('provincia_id',$provincias,$filtros['provincia_id'], 'class="form-control chosen-select" id="provincia_id" onchange="show_poblaciones();"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Poblaciones', 'poblacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div id="poblaciones" class="col-sm-9">
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Zonas', 'zona_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div id="zonas" class="col-sm-9">
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Intereses', 'interes_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('interes_id',$intereses,$filtros['interes_id'], 'class="form-control" id="interes_id"'); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Tipo', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$filtros['tipo_id'], 'class="form-control chosen-select" id="tipo_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Captadores', 'captador_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('captador_id',$agentes,$filtros['captador_id'], 'class="form-control" id="captador_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Fecha alta', 'rango_fecha_alta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-daterange input-group">
                        <input class="input-sm form-control date-picker" name="fecha_desde" id="fecha_desde" value="<?php echo $filtros['fecha_desde']; ?>" data-date-format="dd/mm/yyyy" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control date-picker" name="fecha_hasta" id="fecha_hasta" value="<?php echo $filtros['fecha_hasta']; ?>" data-date-format="dd/mm/yyyy" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="pull-right">
                <button type="submit" name="submit" value="submit" class="btn btn-info">
                    <i class="ace-icon fa fa-search bigger-110"></i>
                    Buscar
                </button>
                <button onclick="return reset_form();" class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Limpiar
                </button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">    
    function show_poblaciones() {
        var provincia_id=$('#provincia_id').val();
        $('#poblaciones').load('<?php echo site_url("common/load_poblaciones");?>/'+provincia_id);
    }
</script>