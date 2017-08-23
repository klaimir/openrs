<?php
if(isset($inmueble_id))
{
    echo form_hidden('inmueble_id',$inmueble_id);
    ?>
    <p>Se ha seleccionado el inmueble con referencia <strong><a href="<?php echo site_url('inmuebles/edit/'.$inmueble_id); ?>"><?php echo $referencia_inmueble; ?></a></strong> para ser asignado al cliente actual</p>
    <?php
}
?>
<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS PERSONALES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('NIF/NIE/CIF', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($nif, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Introduzca el número sin guiones y todo en maýuscula (por ejemplo 75777802R o G32843955)</small>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Nombre', 'nombre', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($nombre, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Apellidos', 'apellidos', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($apellidos, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Fecha de nacimiento', 'fecha_nac', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($fecha_nac, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
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
                <?php echo label('País de residencia', 'pais_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('pais_id',$paises,$pais_id, 'id="pais_id" class="chosen-select form-control" onchange="mark_modified_field(); check_show_provincias();"'); ?>        
                </div>
            </div>
            <div id="provincia_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('Provincia', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('provincia_id',$provincias,$provincia_id, 'class="form-control" id="provincia_id" onchange="mark_modified_field(); show_poblaciones();"'); ?>
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
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Dirección', 'direccion', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($direccion, '', 'class="form-control" onchange="mark_modified_field(); check_google_maps();"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('E-mail', 'correo', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($correo, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="space-4"></div>
            <div class="form-group">            
                <?php echo label('Teléfonos', 'telefonos', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($telefonos, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
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
                <?php echo label('Medio captación', 'medio_captacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('medio_captacion_id',$medios_captacion,$medio_captacion_id, 'id="medio_captacion_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                </div>                
            </div>
            <div class="form-group">            
                <?php echo label('Agente Asignado', 'agente_asignado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
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

        <?php        
        // Es mejor omitirlo para no tener que poner un retardo que igual tampoco funciona pq por cualquier circunstancia tarda mas la población en cargar
        /*if(isset($provincia_id) && $provincia_id!="")
        {
            if(isset($poblacion_id) && $poblacion_id!="")
            {
        ?>
                $('#poblaciones').load('<?php echo site_url("common/load_poblaciones/".$provincia_id."/".$poblacion_id); ?>');
        <?php
            }
            else
            {
        ?>
                $('#poblaciones').load('<?php echo site_url("common/load_poblaciones/".$provincia_id); ?>');                
        <?php
            }
        }    */            
        ?>

        // Comprobamos si hay que mostrar
        check_show_provincias();
        // Debemos introducir un delay cuando se carga el google maps para que de tiempo a que el campo de la población haya sido cargado también
        //setTimeout(check_google_maps, 2000);
        check_google_maps();
    });
    
    function check_show_provincias() {
        var pais_id=$('#pais_id').val();
        if(pais_id==64) 
        {
            $('#provincia_div').show();
            $('#poblacion_div').show();
        }
        else
        {
            $('#provincia_id').val('');
            $('#poblacion_id').val('');
            $('#provincia_div').hide();
            $('#poblacion_div').hide();
        }
    }

    function check_google_maps() {
        var pais_id=$('#pais_id').val();      
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
