<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('demandas/insert?inmueble_id='.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Crear Demanda </span>
        </a>
        <a class="btn btn-info pull-right" href="<?php echo site_url('inmuebles/asociar_demandas/'.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Asociar a demanda existente</span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <?php
        if($element->demandas)
        {
        ?>
        <table class="table table-striped table-bordered table-hover" id="tabgrid_demandas">
            <thead>
                <tr>
                    <th>Ref.</th>
                    <th>Cliente</th>
                    <th>Tipos<br>Inmuebles</th>
                    <th>Lugar</th>
                    <th>Precios</th>
                    <th>Metros</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Observaciones</th>
                    <th>Fecha alta</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($element->demandas)
                {
                    foreach ($element->demandas as $demanda)
                    {
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url("demandas/edit/" . $demanda->id); ?>" class="blue" title="Ver datos de la demanda">
                                <?php echo $demanda->referencia; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url("clientes/edit/" . $demanda->cliente_id); ?>" class="blue" title="Ver datos del cliente">
                                <?php echo $demanda->nombre_cliente; ?>
                            </a>              
                        </td>
                        <td><?php if($demanda->tipos_inmuebles) { echo $demanda->tipos_inmuebles; } else { echo "-"; } ?></td>
                        <td>
                            <?php
                                echo $demanda->nombre_poblacion;
                                if($demanda->zonas) { echo "<br>(". $demanda->zonas . ")";  }
                             ?>
                        </td>
                        <td><?php echo format_interval(number_format($demanda->precio_desde, 0, ",", "."),number_format($demanda->precio_hasta, 0, ",", ".")); ?></td>
                        <td><?php echo format_interval($demanda->metros_desde,$demanda->metros_hasta); ?></td>
                        <td><?php echo format_interval($demanda->habitaciones_desde,$demanda->habitaciones_hasta); ?></td>
                        <td><?php echo format_interval($demanda->banios_desde,$demanda->banios_hasta); ?></td>
                        <td><?php echo $this->utilities->cortar_texto($demanda->observaciones,50); ?></td>
                        <td><?php echo $this->utilities->cambiafecha_bd($demanda->fecha_alta); ?></td>    
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("demandas/edit/" . $demanda->id); ?>" title="Editar cliente">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red borrar-demanda" data-demanda="<?php echo $demanda->id; ?>" data-inmueble="<?php echo $element->id; ?>" href="#" title="Desasignar">
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
                                            <a href="<?php echo site_url("demandas/edit/" . $demanda->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar cliente">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-demanda" data-demanda="<?php echo $demanda->id; ?>" data-inmueble="<?php echo $element->id; ?>" data-rel="tooltip" title="Desasignar">
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
                }
                ?>
            </tbody>
        </table>
        <?php 
        } else {
        ?>
            <p><i class="ace-icon fa fa-info-circle"></i> Actualmente no hay demandas para el inmueble actual</p>
        <?php 
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(function($) {
       
       jQuery(function ($) {
            $('.borrar-demanda').click(function () {
                var demanda = $(this).data("demanda");
                var inmueble = $(this).data("inmueble");
                bootbox.confirm("¿Estás seguro/a de quitar la demanda de este inmueble?", function (result) {
                    if (result) {
                        window.location = '<?php echo site_url('inmuebles/quitar_demanda'); ?>/' + demanda + '/' + inmueble;
                    }
                });
            });
        })
        
        $('#tabgrid_demandas').dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url('assets/admin/js/dataTables.spanish.txt'); ?>"},
            "aoColumns": [
                null, 
                null,
                null,
                null,                
                null,
                null,
                null,
                null,
                null,                
                {"sType": "date-euro"},
                null
            ]
        });
    })
</script>