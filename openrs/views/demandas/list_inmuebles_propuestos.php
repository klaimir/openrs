<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('demandas/asociar_inmuebles/'.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Proponer Inmuebles </span>
        </a>
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
                    <th>Ficha <br> visita</th>
                    <th>Visitado</th>
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
                        <td><?php echo $this->utilities->cortar_texto($inmueble->observaciones,50); ?></td>
                        <td>
                            <?php if($inmueble->ficha_visita_id) { ?>
                                <a href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" title="Editar ficha visita"><i class="ace-icon fa fa-newspaper-o"></i></a>
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
                        <td><?php echo $inmueble->nombre_tipo; ?></td>
                        <td><?php echo $inmueble->nombre_poblacion; ?></td>
                        <td><?php echo $inmueble->nombre_zona; ?></td>
                        <td><a href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" title="Editar inmueble"><?php echo $inmueble->direccion; ?></a></td>
                        <td><?php echo number_format($inmueble->precio_compra, 0, ",", "."); ?></td>
                        <td><?php echo number_format($inmueble->precio_alquiler, 0, ",", "."); ?></td>
                        <td><?php echo $inmueble->metros; ?></td>
                        <td><?php echo $inmueble->habitaciones; ?></td>
                        <td><?php echo $inmueble->banios; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" title="Editar inmueble">
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
<!-- inline scripts related to this page -->
<script type="text/javascript">   
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
    })
</script>