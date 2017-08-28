<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" <?php if(isset($tabgrid)) { echo 'id="'.$tabgrid.'"'; }?> >
            <thead>
                <tr>
                    <th>Ref.</th>
                    <th>Cliente</th>
                    <th>Tipos<br>Inmuebles</th>
                    <th>Lugar</th>
                    <th>Precios</th>
                    <th>Met.</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Observaciones</th>
                    <th>Estado</th>
                    <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                        <th>Fecha mod.</th>
                    <?php } else { ?>
                        <th>Fecha alta</th>
                    <?php } ?>
                    <?php if(!isset($ocultar_datos_adicionales)) { ?>
                    <th>Pro.</th>
                    <th>Pend.</th>
                    <th>Vis.</th>
                    <?php } ?>
                    <th>Opc.</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($elements)
                {
                    foreach ($elements as $element)
                    {
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo site_url("demandas/edit/" . $element->id); ?>" class="blue" title="Editar datos de la demanda">
                                <?php echo $element->referencia; ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?php echo site_url("clientes/edit/" . $element->id); ?>" class="blue" title="Ver datos del cliente">
                                <?php echo $element->nombre_cliente; ?>
                            </a>              
                        </td>
                        <td><?php if($element->tipos_inmuebles) { echo $element->tipos_inmuebles; } else { echo "-"; } ?></td>
                        <td>
                            <?php
                                echo $element->nombre_poblacion;
                                if($element->zonas) { echo "<br>(". $element->zonas . ")";  }
                             ?>
                        </td>
                        <td><?php echo format_interval(number_format($element->precio_desde, 0, ",", "."),number_format($element->precio_hasta, 0, ",", ".")); ?></td>
                        <td><?php echo format_interval($element->metros_desde,$element->metros_hasta); ?></td>
                        <td><?php echo format_interval($element->habitaciones_desde,$element->habitaciones_hasta); ?></td>
                        <td><?php echo format_interval($element->banios_desde,$element->banios_hasta); ?></td>
                        <td><?php echo $this->utilities->cortar_texto($element->observaciones,50); ?></td>
                        <td><?php echo $element->nombre_estado; ?></td>
                        <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                            <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_actualizacion); ?></td>
                        <?php } else { ?>
                            <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_alta); ?></td>
                        <?php } ?> 
                        <?php if(!isset($ocultar_datos_adicionales)) { ?>
                        <td><?php echo $element->num_inmuebles_propuestos; ?></td>
                        <td><?php echo $element->num_inmuebles_pendientes; ?></td>
                        <td><?php echo $element->num_inmuebles_propuestos_visita; ?></td>
                        <?php } ?>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("demandas/edit/" . $element->id); ?>" title="Editar">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                                
                                <a class="blue" href="<?php echo site_url("demandas/duplicar/" . $element->id); ?>" title="Duplicar">
                                    <i class="ace-icon fa fa-copy bigger-130"></i>
                                </a>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                        <li>
                                            <a href="<?php echo site_url("demandas/edit/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-elemento" data-id="<?php echo $element->id; ?>" data-rel="tooltip" title="Borrar">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                        
                                        <li>
                                            <a href="<?php echo site_url("demandas/duplicar/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Duplicar">
                                                <span class="blue">
                                                    <i class="ace-icon fa fa-copy bigger-120"></i>
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
    </div>
</div>