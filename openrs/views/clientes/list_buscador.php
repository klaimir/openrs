<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" <?php if(isset($tabgrid)) { echo 'id="'.$tabgrid.'"'; }?>>
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>Provincia</th>
                    <th>Municipio</th>                    
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Estado</th>
                    <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                        <th>Fecha mod.</th>
                    <?php } else { ?>
                        <th>Fecha alta</th>
                    <?php } ?>
                    <th>Ofe.</th>
                    <th>Dem.</th>
                    <th>Inm.<br> Dem.</th>
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
                            <a href="<?php echo site_url("clientes/edit/" . $element->id); ?>" class="blue" title="Editar datos del cliente">
                                <?php echo $element->apellidos.", ".$element->nombre; ?>
                            </a>
                        </td>
                        <td><?php echo $element->nif; ?></td>
                        <td><?php echo $element->nombre_provincia; ?></td>
                        <td><?php echo $element->nombre_poblacion; ?></td>
                        <td><?php echo $element->telefonos; ?></td>
                        <td><?php echo $element->correo; ?></td>
                        <td><?php echo $element->nombre_estado; ?></td>
                        <?php if(isset($show_fecha_modificacion) && $show_fecha_modificacion) { ?>
                            <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_actualizacion); ?></td>
                        <?php } else { ?>
                            <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_alta); ?></td>
                        <?php } ?>                        
                        <td><?php echo $element->num_propiedades; ?></td>
                        <td><?php echo $element->num_demandas; ?></td>
                        <td><?php echo $element->num_inmuebles_demandados; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("clientes/edit/" . $element->id); ?>" title="Editar">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                                
                                <a class="blue" href="<?php echo site_url("clientes/duplicar/" . $element->id); ?>" title="Duplicar">
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
                                            <a href="<?php echo site_url("clientes/edit/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
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
                                            <a href="<?php echo site_url("clientes/duplicar/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Duplicar">
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