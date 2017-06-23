<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('demandas/asociar_inmuebles/'.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Proponer Inmuebles </span>
        </a>
        <?php if($element->inmuebles_propuestos) { ?>
            <a class="btn btn-info pull-right" onclick="check_multiple_google_maps();">
                <i class="menu-icon fa fa-map-marker"></i>
                <span class="menu-text"> Ver en mapa </span>
            </a>
        <?php } ?>
    </div>
</div>

<div class="row" id="google_maps_div" style="display:none;">      
    <div class="space-10"></div>
    <div class="col-xs-12">
        <div id="google_maps">
        </div>
        <small class="blue">El mapa está cargándose, espere unos segundos... Aparecerá centrado en la provincia o población seleccionado en su filtro de búsqueda. Si no seleccionó ninguna de las dos, entonces se centrará en su posición actual. Esta opción sólo funcionará si tiene habilitado en su dispositivo la geolocalización y no está bloqueado para el navegador web actual.</small>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <?php
        if($element->inmuebles_propuestos)
        {
        ?>
        <table class="table table-striped table-bordered table-hover" id="tabgrid_inmuebles_propuestos">
            <thead>
                <tr>
                    <th>Origen</th>
                    <th>Estado</th>
                    <th>Fecha asig.</th>
                    <th>Obs.</th>
                    <th>Fecha <br> visita</th>
                    <th>Visitado</th>
                    <th>Ref.</th>
                    <th>Tipología</th>
                    <th>Municipio</th>
                    <th>Zona</th>
                    <th>Dirección</th>
                    <th>Precio <br> Compra</th>
                    <th>Precio <br> Alquiler</th>
                    <th>Met.</th>
                    <th>Hab.</th>
                    <th>Bañ.</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($element->inmuebles_propuestos as $inmueble)
                    {
                    ?>
                    <tr>
                        <td><?php echo $inmueble->nombre_origen; ?></td>
                        <td><?php echo $inmueble->nombre_evaluacion; ?></td>
                        <td><?php echo $inmueble->fecha_asignacion_formateada; ?></td>
                        <td><?php echo $this->utilities->cortar_texto($inmueble->observaciones_demanda,50); ?></td>
                        <td>
                            <?php if($inmueble->ficha_visita_id) { ?>
                                <a href="<?php echo site_url("demandas_fichas_visita/edit/" . $inmueble->ficha_visita_id); ?>" title="Editar ficha visita"><?php echo $inmueble->fecha_hora_visita_formateada; ?></a>
                            <?php } else { ?>
                                -
                            <?php } ?>
                        </td>
                        <td>
                            <?php if($inmueble->visitado) { ?>
                                <i class="ace-icon fa fa-check-square"></i>
                            <?php } else { ?>
                                <i class="ace-icon fa fa-close"></i>
                            <?php } ?>
                        </td>
                        <td><a href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" title="Editar inmueble"><?php echo $inmueble->referencia; ?></a></td>
                        <td><?php echo $inmueble->nombre_tipo; ?></td>
                        <td><?php echo $inmueble->nombre_poblacion; ?></td>
                        <td><?php echo $inmueble->nombre_zona; ?></td>
                        <td><?php echo $inmueble->direccion; ?></td>
                        <td><?php echo number_format($inmueble->precio_compra, 0, ",", "."); ?></td>
                        <td><?php echo number_format($inmueble->precio_alquiler, 0, ",", "."); ?></td>
                        <td><?php echo $inmueble->metros; ?></td>
                        <td><?php echo $inmueble->habitaciones; ?></td>
                        <td><?php echo $inmueble->banios; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green inmueble_propuesto" data-target="#modificar_datos_inmueble_propuesto" href="#" data-toggle="modal" data-id="<?php echo $inmueble->inmueble_demanda_id;?>" title="Modificar datos de inmueble propuesto">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red borrar-propiedad" data-inmueble="<?php echo $inmueble->id; ?>" href="#" title="Desasignar">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </div>
                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar inmueble">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-propiedad" data-inmueble="<?php echo $inmueble->id; ?>" data-rel="tooltip" title="Desasignar">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>                    
                        </td>
                    </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
        <?php 
        } else {
        ?>
            <p><i class="ace-icon fa fa-info-circle"></i> Actualmente no hay inmuebles asociados a la demanda actual</p>
        <?php 
        }
        ?>
    </div>
</div>
<div class="modal fade" id="modificar_datos_inmueble_propuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-url="<?php echo site_url('demandas/update_inmueble_propuesto'); ?>">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modificar datos de inmueble propuesto</h4>
      </div>
      <div class="modal-body form-horizontal" id="modal-body">
      </div>        
      <div class="modal-footer">
        <button class="btn btn-small" data-dismiss="modal">
            <i class="icon-remove"></i>
            Cancelar
        </button>

        <button class="btn btn-small btn-primary">
            <i class="icon-ok"></i>
            Aplicar
        </button>
      </div>
    </div>
  </div>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">   
    function check_multiple_google_maps() {
        $('#google_maps_div').toggle('slow');
        $('#google_maps').load('<?php echo site_url('demandas/google_map_inmuebles_propuestos/'.$element->id);?>');
    }
    
    jQuery(function ($) {
        $('.borrar-propiedad').click(function () {
            var inmueble = $(this).data("inmueble");
            bootbox.confirm("¿Estás seguro/a de quitar la propiedad de este demanda?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url('demandas/quitar_inmueble/'.$element->id); ?>/' + inmueble;
                }
            });
        });
        
        $('#tabgrid_inmuebles_propuestos').dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url('assets/admin/js/dataTables.spanish.txt'); ?>"},
            "aoColumns": [
                null,                
                null,
                {"sType": "date-euro"},
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
        
        $('.inmueble_propuesto').on('click', function(e){
            var id = $(this).data('id');
            $('#modal-body').load('<?php echo site_url("demandas/cargar_inmueble_propuesto"); ?>/' + id);
        });
        
        $('#modificar_datos_inmueble_propuesto .btn-primary').on('click', function () {
            var modal=$(this).parents('#modificar_datos_inmueble_propuesto');
            var posturl=$(modal).data('url');
            var datastring=$(modal).find('input,select,textarea').serialize();
            $.ajax({
                type: 'POST',
                data: datastring,
                url: posturl,
                success: function(data) {
                    if (data==1) {   
                        window.location = '<?php echo site_url('demandas/edit/'.$element->id); ?>';
                    } else {
                        alert(data);
                    }
                }
            });
        });
    })
</script>