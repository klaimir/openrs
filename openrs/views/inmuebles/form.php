<?php
if(isset($cliente_id))
{
    ?>
    <p>Se ha seleccionado el cliente <strong><a href="<?php echo site_url('clientes/edit/'.$cliente_id); ?>"><?php echo $nif_cliente; ?> - <?php echo $nombre_completo_cliente; ?></a></strong> para ser asignado al inmueble actual</p>
    <?php
}
?>
<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS GENERALES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('(*) Referencia', 'referencia', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($referencia, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Puede introducir cualquier secuencia de caracteres alfanumérica que no esté ya registrada en el sistema</small>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Tipo', 'tipo_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('tipo_id',$tipos_inmuebles,$tipo_id, 'id="tipo_id" onchange="mark_modified_field();" class="chosen-select form-control"'); ?>        
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Fecha de alta', 'fecha_alta', 'class="col-sm-3 control-label no-padding-right"'); ?>
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
            UBICACIÓN
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">            
            <div id="provincia_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('(*) Provincia', 'provincia_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div class="col-sm-9">
                        <?php echo form_dropdown('provincia_id',$provincias,$provincia_id, 'onchange="mark_modified_field(); show_poblaciones();" class="chosen-select form-control" id="provincia_id"'); ?>
                    </div>
                </div>
            </div>
            <div id="poblacion_div"> 
                <div class="space-4"></div>
                <div class="form-group">            
                    <?php echo label('(*) Población', 'poblacion_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
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
                <?php echo label('(*) Dirección', 'direccion', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($direccion, '', 'class="form-control" onchange="check_google_maps(); mark_modified_field();"'); ?>
                    <small class="blue">
                        Deberá introducir la dirección especificando el tipo de vía al principio, si lo desea, el nombre de la vía, el número de portal, piso, etc. No utilice símbolos ordinales como º o ª. Todo separado por un especio y comas simples ",". 
                        Si lo desea agregue el C.P. al final, también separado por ",". Por ejemplo, Calle Pinito del Oro, 4, 6 C, 04009. La población y la provincia no deben escribirse, ya que se tomarán de los datos introducidos anteriormente.
                    </small>
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
                <?php echo label('(*) Metros', 'metros', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Metros útiles', 'metros_utiles', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($metros_utiles, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Habitaciones', 'habitaciones', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($habitaciones, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Baños', 'banios', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($banios, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio compra', 'precio_compra', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_compra, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Sin decimales ni signos de puntuación. Si especifica un precio positivo el inmueble estará en venta.</small>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio compra anterior', 'precio_compra', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_compra_anterior, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Sin decimales ni signos de puntuación. Si especifica un precio positivo mayor que el de compra estará reflejando una bajada de precio. Si especifica un precio menor será una subida. 
                        Si no desea especificar ni subida ni bajada deje el campo a 0 o vacío</small>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio Alquiler', 'precio_alquiler', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_alquiler, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Sin decimales ni signos de puntuación. Si especifica un precio positivo el inmueble estará en alguiler. El precio sólo puede ser mensual a no ser que especifique usted lo contrario en la descripción.
                    Si además el precio de compra el positivo, el inmueble está a la venta o en alguiler.</small>
                </div>
            </div>
            <div class="form-group">
                <?php echo label('Precio alquiler anterior', 'precio_alquiler', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($precio_alquiler_anterior, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    <small class="blue">Sin decimales ni signos de puntuación. Si especifica un precio positivo mayor que el de alquiler estará reflejando una bajada de precio. Si especifica un precio menor será una subida. 
                        Si no desea especificar ni subida ni bajada deje el campo a 0 o vacío</small>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*) Certificación energética', 'certificacion_energetica_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('certificacion_energetica_id',$tipos_certificacion_energetica,$certificacion_energetica_id, 'id="certificacion_energetica_id" onchange="mark_modified_field(); check_show_kwh_m2_anio();" class="form-control"'); ?>        
                    <small class="blue">
                        De acuerdo al RD 235/2013, de 5 de abril, te recordamos que, en función del tipo de inmueble de que se trate y del consumo previsto, debes indicar su nivel de certificación de eficiencia energética en el desplegable de la ficha del anuncio. 
                        Para más información puede acceder <strong><a target="_blank" href="http://noticias.juridicas.com/base_datos/Admin/503283-real-decreto-235-2013-de-5-de-abril-por-el-que-se-aprueba-el-procedimiento.html"> aquí</a></strong>.
                    </small>
                </div>                
            </div>
            <div id="kwh_m2_anio_div">
                <div class="form-group">            
                    <?php echo label('(*1) Consumo Kwh/m2 anual', 'kwh_m2_anio', 'class="col-sm-3 control-label no-padding-right"'); ?>
                    <div class="col-sm-9">
                        <?php echo form_input($kwh_m2_anio, '', 'onchange="mark_modified_field();" class="form-control"'); ?>
                    </div>
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

<?php if(isset($element)) { ?>
<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            <a name="publicacion">DATOS ZONA PÚBLICA</a> <?php if($url_publica) { ?> ( - <a target="_blank" href="<?php echo $url_publica; ?>">Ver vista pública</a> - ) <?php } ?>
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('Publicado', 'publicado', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_checkbox('publicado', '1', $publicado_checked, 'class="checkbox" onchange="mark_modified_field();"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Destacado', 'destacado', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_checkbox('destacado', '1', $destacado_checked, 'class="checkbox" onchange="mark_modified_field();"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('Oportunidad', 'oportunidad', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_checkbox('oportunidad', '1', $oportunidad_checked, 'class="checkbox" onchange="mark_modified_field();"'); ?>
                </div>
            </div>
            <div class="form-group">            
                <?php echo label('(*2) Dirección pública', 'direccion_publica', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_input($direccion_publica, '', 'class="form-control" onchange="check_google_maps(1); mark_modified_field();"'); ?>
                    
                </div>
            </div>  
            <div class="form-group" id="google_maps_div_public">            
                <?php echo label('Ubicación Google Maps', 'google_maps_label', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div id="google_maps_public" class="col-sm-9">
                </div>
            </div>
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
                                        <?php echo label('(*2) Título', 'titulo_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                                        <div class="col-sm-9">
                                            <?php echo form_input($datos_idioma[$idioma->id_idioma]['titulo'], '', 'class="form-control" onchange="mark_modified_field();"'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">            
                                        <?php echo label('(*2) Descripción', 'descripcion_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                                        <div class="col-sm-9">
                                            <?php echo form_textarea($datos_idioma[$idioma->id_idioma]['descripcion'],'','onchange="mark_modified_field();" class="ckeditor"'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">            
                                        <?php echo label('URL SEO', 'url_seo_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                                        <div class="col-sm-9">
                                            <?php echo form_input($datos_idioma[$idioma->id_idioma]['url_seo'], '', 'class="form-control" onchange="mark_modified_field();"'); ?>
                                            <?php echo form_hidden($datos_idioma[$idioma->id_idioma]['url_seo_anterior']['name'], $datos_idioma[$idioma->id_idioma]['url_seo_anterior']['value']); ?>
                                            <small class="blue">Si deja este campo sin rellenar se creará a partir del título indicado</small>
                                        </div>
                                    </div>
                                    <div class="form-group">            
                                        <?php echo label('(*2) Descripción SEO', 'descripcion_seo_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                                        <div class="col-sm-9">
                                            <?php echo form_input($datos_idioma[$idioma->id_idioma]['descripcion_seo'], '', 'class="form-control" onchange="mark_modified_field();"'); ?>
                                            
                                            <small class="blue">Utilice una descripción corta del inmueble (max. 150 caracteres)</small>
                                        </div>
                                    </div>
                                    <div class="form-group">            
                                        <?php echo label('(*2) Palabras clave SEO', 'keywords_seo_'.$idioma->id_idioma, 'class="col-sm-3 control-label no-padding-right"'); ?>
                                        <div class="col-sm-9">
                                            <?php echo form_input($datos_idioma[$idioma->id_idioma]['keywords_seo'], '', 'class="form-control" onchange="mark_modified_field();"'); ?>
                                            <small class="blue">Introduzca las palabras separadas por comas ","</small>
                                        </div>
                                    </div>
                                </div>
                    <?php } ?>
                </div>
            </div>
        </div>        
    </div>
</div>
<?php } ?>

<div class="widget-box">
    <div class="widget-header">
        <h4 class="widget-title">
            DATOS AUXILIARES
        </h4>
    </div>
    <div class="widget-body">
        <div class="widget-main">
            <div class="form-group">            
                <?php echo label('(*) Estado', 'estado_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('estado_id',$estados,$estado_id, 'id="estado_id" onchange="mark_modified_field();" class="form-control"'); ?>        
                </div>                
            </div>
            <div class="form-group">
                <?php echo label('Agente Asignado', 'captador_id', 'class="col-sm-3 control-label no-padding-right"'); ?>
                <div class="col-sm-9">
                    <?php echo form_dropdown('captador_id',$agentes,$captador_id, 'onchange="mark_modified_field();" class="form-control" id="captador_id"'); ?>
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
    
<small class="blue">
    Los campos marcados con (*) son obligatorios. Los campos marcados con (*1) son obligatorios sólo si se ha seleccionado un tipo concreto de certificado energético. 
    Los campos marcados con (*2) son obligatorios sólo si se ha publicado el inmueble.
</small>

<script type="text/javascript">
    $(document).ready(function(){
        // Comprobamos si hay que mostrar kwh_m2_anio
        check_show_kwh_m2_anio();
        
        // Comprobamos si hay que mostrar mapa google maps
        <?php if(isset($element)) { ?>
            check_google_maps(1);  
        <?php } ?>
        check_google_maps();  
    });

    function check_google_maps(tipo) {
        var pais_id=64;      
        
        if(tipo==1)
        {
            var campo_direccion='#direccion_publica';
            var capa_div='#google_maps_div_public';
            var capa_mapa='#google_maps_public';
            var number_map=2;
        }
        else
        {
            var campo_direccion='#direccion';
            var capa_div='#google_maps_div';
            var capa_mapa='#google_maps';
            var number_map=1;
        }
        
        var direccion=$(campo_direccion).val();

        if(pais_id!='' && direccion!='')
        {
            $(capa_div).show();     
            
            var poblacion_id=$('#poblacion_id').val();
            var provincia_id=$('#provincia_id').val();

            if(poblacion_id!='' && provincia_id!='')
            {
                var url='/common/single_google_map/'+number_map+'?direccion='+direccion+'&provincia_id='+provincia_id+'&poblacion_id='+poblacion_id+'&pais_id='+pais_id;
            }
            else
            {
                var url='/common/single_google_map/'+number_map+'?direccion='+direccion+'&pais_id='+pais_id;
            }
            
            var url_encode = encodeURI(url);

            $(capa_mapa).load('<?php echo site_url();?>'+url_encode);
        }
        else
        {
            $(capa_div).hide();
        }
    }
    
    function check_show_kwh_m2_anio() {
        var certificacion_energetica_id=$('#certificacion_energetica_id').val();
        if(certificacion_energetica_id!=8 && certificacion_energetica_id!=9) 
        {
            $('#kwh_m2_anio_div').show();
        }
        else
        {
            $('#kwh_m2_anio').val('');
            $('#kwh_m2_anio_div').hide();
        }
    }

    function show_poblaciones() {
        var provincia_id=$('#provincia_id').val();
        $('#poblaciones').load('<?php echo site_url("common/load_poblaciones");?>/'+provincia_id);
    }
</script>
