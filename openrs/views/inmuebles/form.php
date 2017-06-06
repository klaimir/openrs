<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS GENERALES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('NIF/NIE/CIF', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($nif, '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($nombre, '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Apellidos', 'apellidos', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($apellidos, '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Fecha de nacimiento', 'fecha_nac', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($fecha_nac, '', 'class="form-control"'); ?>
                    <small class="blue">Introduzca la fecha en formato dd/mm/aaaa (por ejemplo; 19/05/1982)</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            CONTACTO
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Tipo', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$tipo_id, 'id="tipo_id" class="chosen-select form-control"'); ?>        
                </div>
            </div>
            <div id="provincia_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Provincia', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('provincia_id',$provincias,$provincia_id, 'class="form-control" id="provincia_id" onchange="show_poblaciones();"'); ?>
                    </div>
                </div>
            </div>
            <div id="poblacion_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Población', 'poblacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div id="poblaciones" class="col-sm-9">
                        <?php echo form_dropdown('poblacion_id',$poblaciones,$poblacion_id, 'class="chosen-select form-control" id="poblacion_id""'); ?>
                    </div>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Dirección', 'direccion', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($direccion, '', 'class="form-control" onchange="check_google_maps();"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('E-mail', 'correo', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($correo, '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Teléfonos', 'telefonos', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($telefonos, '', 'class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group" id="google_maps_div">            
                <?php echo label('Ubicación Google Maps', 'google_maps_label', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div id="google_maps" class="col-sm-9">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            CAPTACION
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Captador', 'captador_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('captador_id',$agentes,$captador_id, 'class="form-control" id="captador_id"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Observaciones', 'observaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_textarea($observaciones,'','class="ckeditor"'); ?>
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
