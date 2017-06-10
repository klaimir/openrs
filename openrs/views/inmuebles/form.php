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
                <?php echo label('Tipo', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$tipo_id, 'id="tipo_id" onchange="mark_modified_field();" class="chosen-select form-control"'); ?>        
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

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            UBICACION
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
                        <?php echo form_dropdown('zona_id',$zonas,$zona_id, 'onchange="mark_modified_field();" class="chosen-select form-control" id="zona_id""'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Dirección', 'direccion', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($direccion, '', 'class="form-control" onchange="check_google_maps(); mark_modified_field();"'); ?>
                </div>
            </div>
            <div class="form-group" id="google_maps_div">            
                <?php echo label('Ubicación Google Maps', 'google_maps_label', 'onchange="mark_modified_field();" class="col-sm-3 control-label no-padding-right"'); ?>
                <div id="google_maps" class="col-sm-9">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS ESPECÍFICOS
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('Metros', 'metros', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Metros útiles', 'metros_utiles', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros_utiles, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Habitaciones', 'habitaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($habitaciones, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Baños', 'banios', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($banios, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio Compra', 'precio_compra', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_compra, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio Alquiler', 'precio_alquiler', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_alquiler, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Certificación energética', 'certificacion_energetica_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('certificacion_energetica_id',$tipos_certificacion_energetica,$certificacion_energetica_id, 'id="certificacion_energetica_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                    <small class="blue">
                        De acuerdo al RD 235/2013, de 5 de abril, te recordamos que, en función del tipo de inmueble de que se trate y del consumo previsto, debes indicar su nivel de certificación de eficiencia energética en el desplegable de la ficha del anuncio. 
                        Para más información puede acceder <strong><a target="_blank" href="http://noticias.juridicas.com/base_datos/Admin/503283-real-decreto-235-2013-de-5-de-abril-por-el-que-se-aprueba-el-procedimiento.html"> aquí</a></strong>.
                    </small>
                </div>                
            </div>
            <div class="form-group">            
                <?php echo label('Año construcción', 'anio_construccion', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($anio_construccion, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Introduzca el año en formato aaaa (por ejemplo; 1982)</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS AUXILIARES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Captador', 'captador_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('captador_id',$agentes,$captador_id, 'onchange="mark_modified_field();" class="form-control" id="captador_id"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Observaciones', 'observaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_textarea($observaciones,'','onchange="mark_modified_field();" class="ckeditor"'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        // Comprobamos si hay que mostrar mapa google maps
        check_google_maps();        
    });

    function check_google_maps() {
        var pais_id=64;      
        var direccion=$('#direccion').val();

        if(pais_id!='' && direccion!='')
        {
            $('#google_maps_div').show();     
            
            var poblacion_id=$('#poblacion_id').val();
            var provincia_id=$('#provincia_id').val();

            if(poblacion_id!='' && provincia_id!='')
            {
                var url='/common/single_google_map?direccion='+direccion+'&provincia_id='+provincia_id+'&poblacion_id='+poblacion_id+'&pais_id='+pais_id;
            }
            else
            {
                var url='/common/single_google_map?direccion='+direccion+'&pais_id='+pais_id;
            }
            
            var url_encode = encodeURI(url);

            $('#google_maps').load('<?php echo site_url();?>'+url_encode);
        }
        else
        {
            $('#google_maps_div').hide();
        }
    }

    function show_poblaciones() {
        var provincia_id=$('#provincia_id').val();
        $('#poblaciones').load('<?php echo site_url("common/load_poblaciones");?>/'+provincia_id);
    }
</script>
