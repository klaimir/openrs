<div class="well" id="buscador">
    <?php echo form_open('demandas', 'class="form-horizontal" method="get"'); ?>    
    <div class="row">
        <div class="col-xs-12">
            <h4>Datos generales</h4>
            <hr>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Clientes', 'cliente_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('cliente_id',$clientes,$filtros['cliente_id'], 'class="form-control chosen-select" id="cliente_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Tipo inmueble', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$filtros['tipo_id'], 'class="form-control chosen-select" id="tipo_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Ofertas', 'oferta_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('oferta_id',$ofertas,$filtros['oferta_id'], 'class="form-control" id="oferta_id"'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Tipo demanda', 'tipo_demanda_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_demanda_id',$tipos_demandas,$filtros['tipo_demanda_id'], 'class="form-control" id="tipo_demanda_id"'); ?>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Agente asignado', 'agente_asignado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('agente_asignado_id',$agentes,$filtros['agente_asignado_id'], 'class="form-control" id="agente_asignado_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Certificación energética', 'certificacion_energetica_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('certificacion_energetica_id',$tipos_certificacion_energetica,$filtros['certificacion_energetica_id'], 'class="form-control" id="certificacion_energetica_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Estados', 'estado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('estado_id',$estados,$filtros['estado_id'], 'class="form-control" id="estado_id"'); ?>
                </div>
            </div>            
            <div class="form-group">            
                <?php echo label('Fecha alta', 'rango_fecha_alta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-range input-group">
                        <input class="input-sm form-control date-picker" name="fecha_desde" id="fecha_desde" value="<?php echo $filtros['fecha_desde']; ?>" data-date-format="dd/mm/yyyy" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control date-picker" name="fecha_hasta" id="fecha_hasta" value="<?php echo $filtros['fecha_hasta']; ?>" data-date-format="dd/mm/yyyy" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <h4>Ubicación</h4>
            <hr>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Provincias', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('provincia_id',$provincias,$filtros['provincia_id'], 'class="form-control chosen-select" id="provincia_id" onchange="show_poblaciones();"'); ?>
                </div>
            </div>            
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
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
        </div>
        
        <div class="col-xs-12">
            <h4>Datos específicos</h4>
            <hr>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Habitaciones', 'rango_habitaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-range input-group">
                        <input class="input-sm form-control" name="habitaciones_desde" id="habitaciones_desde" value="<?php echo $filtros['habitaciones_desde']; ?>" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control" name="habitaciones_hasta" id="habitaciones_hasta" value="<?php echo $filtros['habitaciones_hasta']; ?>" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Precios', 'rango_precios', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-range input-group">
                        <input class="input-sm form-control" name="precios_desde" id="precios_desde" value="<?php echo $filtros['precios_desde']; ?>" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control" name="precios_hasta" id="precios_hasta" value="<?php echo $filtros['precios_hasta']; ?>" type="text">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
            <div class="form-group">            
                <?php echo label('Baños', 'rango_banios', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-range input-group">
                        <input class="input-sm form-control" name="banios_desde" id="banios_desde" value="<?php echo $filtros['banios_desde']; ?>" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control" name="banios_hasta" id="banios_hasta" value="<?php echo $filtros['banios_hasta']; ?>" type="text">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Metros', 'rango_metros', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <div class="input-range input-group">
                        <input class="input-sm form-control" name="metros_desde" id="metros_desde" value="<?php echo $filtros['metros_desde']; ?>" type="text">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <input class="input-sm form-control" name="metros_hasta" id="metros_hasta" value="<?php echo $filtros['metros_hasta']; ?>" type="text">
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