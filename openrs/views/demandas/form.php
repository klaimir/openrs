<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS GENERALES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('Referencia', 'referencia', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($referencia, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Cliente', 'cliente_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('cliente_id',$clientes,$cliente_id, 'onchange="mark_modified_field();" class="form-control chosen-select" id="cliente_id"'); ?>
                </div>
            </div> 
            <div class="form-group">            
                <?php echo label('Oferta', 'oferta_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('oferta_id',$ofertas,$oferta_id, 'onchange="mark_modified_field();" class="form-control" id="oferta_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Tipo demanda', 'tipo_demanda_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_demanda_id',$tipos_demandas,$tipo_demanda_id, 'onchange="mark_modified_field(); check_show_filtros();" class="form-control" id="tipo_demanda_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Fecha de alta', 'fecha_alta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($fecha_alta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Introduzca la fecha en formato dd/mm/aaaa (por ejemplo; 19/05/1982)</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box" id="ubicacion">
    <div class="widget-header">
        <h4 class="widget-title">
            UBICACIÓN
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">            
            <div id="provincia_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Provincia', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('provincia_id',$provincias,$provincia_id, 'onchange="mark_modified_field(); show_poblaciones();" class="form-control" id="provincia_id"'); ?>
                    </div>
                </div>
            </div>
            <div id="poblacion_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Población', 'poblacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div id="poblaciones" class="col-sm-9">
                        <?php echo form_dropdown('poblacion_id',$poblaciones,$poblacion_id, 'onchange="mark_modified_field();" class="chosen-select form-control" id="poblacion_id""'); ?>
                    </div>
                </div>
            </div>
            <div id="zona_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Zona', 'zona_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div id="zonas" class="col-sm-9">
                        <?php 
                        if(count($zonas))
                        {
                            echo form_multiselect('zonas_id[]',$zonas,$zonas_seleccionadas, 'onchange="mark_modified_field();" class="form-control" id="zonas_id""'); 
                        }
                        else
                        {
                            echo '<p class="form-control"><i class="ace-icon fa fa-info-circle"></i> Actualmente no existen zonas registradas para la población seleccionada</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box" id="datos_especificos">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS ESPECÍFICOS
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('Tipo inmueble', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_multiselect('tipos_id[]',$tipos_inmuebles,$tipos_inmuebles_seleccionados, 'id="tipos_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio (desde)', 'precio_desde', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_desde, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio (hasta)', 'precio_hasta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_hasta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Habitaciones (desde)', 'abitaciones_desde', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($habitaciones_desde, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Habitaciones (hasta)', 'abitaciones_hasta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($habitaciones_hasta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Baños (desde)', 'banios_desde', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($banios_desde, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Baños (hasta)', 'banios_hasta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($banios_hasta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Metros (desde)', 'metros_desde', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros_desde, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Metros (hasta)', 'metros_hasta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros_hasta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>   
            <div class="form-group">            
                <?php echo label('Año construcción (desde)', 'anio_construccion_desde', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($anio_construccion_desde, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Introduzca el año en formato aaaa (por ejemplo; 1982)</small>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Año construcción (hasta)', 'anio_construccion_hasta', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($anio_construccion_hasta, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Introduzca el año en formato aaaa (por ejemplo; 1982)</small>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Certificación energética (mínima)', 'certificacion_energetica_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('certificacion_energetica_id',$tipos_certificacion_energetica,$certificacion_energetica_id, 'id="certificacion_energetica_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                </div>                
            </div>            
        </div>
    </div>
</div>

<div class="widget-box" id="datos_auxiliares">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS AUXILIARES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('Estado', 'estado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('estado_id',$estados,$estado_id, 'id="estado_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                </div>                
            </div>
            <div class="form-group">            
                <?php echo label('Agente asignado', 'agente_asignado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('agente_asignado_id',$agentes,$agente_asignado_id, 'onchange="mark_modified_field();" class="form-control" id="agente_asignado_id"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Observaciones', 'observaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_textarea($observaciones,'','onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // Comprobamos si hay que mostrar
        check_show_filtros();        
    });    
    
    function check_show_filtros() {
        var tipo_demanda_id=$('#tipo_demanda_id').val();
        if(tipo_demanda_id==2) 
        {
            $('#ubicacion').show();
            $('#datos_especificos').show();
        }
        else
        {
            $('#tipo_id').val('');
            $('#certificacion_energetica_id').val('');
            $('#provincia_id').val('');
            $('#poblacion_id').val('');
            $('#zona_id').val('');  
            $('#fecha_desde').val('');
            $('#fecha_hasta').val('');
            $('#banios_desde').val('');
            $('#banios_hasta').val('');
            $('#habitaciones_desde').val('');
            $('#habitaciones_hasta').val('');
            $('#metros_desde').val('');
            $('#metros_hasta').val('');
            $('#precio_desde').val('');
            $('#precio_hasta').val('');
            $('#anio_construccion_desde').val('');
            $('#anio_construccion_hasta').val('');
            $('#ubicacion').hide();
            $('#datos_especificos').hide();
            // Resetear los valores no es suficiente para los chosen select, hay que hacer esto tb
            $('#poblacion_id').html('<span>- Seleccione -</span><div><b></b></div>');
            $('#zona_id').html('<span>- Seleccione -</span><div><b></b></div>');
            $('#tipo_id').html('<span>- Seleccione -</span><div><b></b></div>');
        }
    }

    function show_poblaciones() {
        var provincia_id=$('#provincia_id').val();
        $('#poblaciones').load('<?php echo site_url("demandas/load_poblaciones");?>/'+provincia_id);
    }
</script>
