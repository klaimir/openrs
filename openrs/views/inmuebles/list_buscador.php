<table class="table table-striped table-bordered table-hover" <?php if(isset($tabgrid)) { echo 'id="'.$tabgrid.'"'; }?> >
    <thead>
        <tr>
            <th>Ref.</th>
            <th>Tipo</th>
            <th>Municipio</th>
            <th>Zona</th>
            <th>Dirección</th>
            <th>Precio<br> Compra</th>
            <th>Precio<br> Alquiler</th>
            <th>Met.</th>
            <th>Hab.</th>
            <th>Bañ.</th>
            <th>Estado</th>
            <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                <th>Fecha mod.</th>
            <?php } else { ?>
                <th>Fecha alta</th>
            <?php } ?>   
            <th>Prop.</th>
            <th>Dem.</th>
            <th>Pend.</th>
            <th>Vis.</th>
            <th>Opciones</th>
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
                    <a href="<?php echo site_url("inmuebles/edit/" . $element->id); ?>" class="blue" title="Editar datos del inmueble">
                        <?php echo $element->referencia; ?>
                    </a>
                </td>
                <td><?php echo $element->nombre_tipo; ?></td>
                <td><?php echo $element->nombre_poblacion; ?></td>
                <td><?php echo $element->nombre_zona; ?></td>
                <td><?php echo $element->direccion; ?></td>
                <td><?php echo number_format($element->precio_compra, 0, ",", "."); ?></td>
                <td><?php echo number_format($element->precio_alquiler, 0, ",", "."); ?></td>
                <td><?php echo $element->metros; ?></td>
                <td><?php echo $element->habitaciones; ?></td>
                <td><?php echo $element->banios; ?></td>
                <td><?php echo $element->nombre_estado; ?></td>
                <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                    <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_actualizacion); ?></td>
                <?php } else { ?>
                    <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_alta); ?></td>
                <?php } ?> 
                <td><?php echo $element->num_propietarios; ?></td>
                <td><?php echo $element->num_demandas_totales; ?></td>
                <td><?php echo $element->num_demandas_pendientes; ?></td>
                <td><?php echo $element->num_demandas_propuestas_visita; ?></td>
                <td>
                    <div class="hidden-sm hidden-xs action-buttons">
                        <a class="green" href="<?php echo site_url("inmuebles/edit/" . $element->id); ?>" title="Editar">
                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                        </a>

                        <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
                            <i class="ace-icon fa fa-trash-o bigger-130"></i>
                        </a>

                        <a class="blue" href="<?php echo site_url("inmuebles/duplicar/" . $element->id); ?>" title="Duplicar">
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
                                    <a href="<?php echo site_url("inmuebles/edit/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
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
                                    <a href="<?php echo site_url("inmuebles/duplicar/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Duplicar">
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