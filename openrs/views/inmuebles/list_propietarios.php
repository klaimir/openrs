<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('clientes/insert/'.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Crear Propietario </span>
        </a>
        <a class="btn btn-info pull-right" href="<?php echo site_url('inmuebles/asociar_clientes/'.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Asociar Clientes </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Ficha encargo</th>
                    <th>Cláusula Cert. Ener.</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($element->propietarios)
                {
                    foreach ($element->propietarios as $propietario)
                    {
                    ?>
                    <tr>
                        <td><?php echo $propietario->apellidos.", ".$propietario->nombre; ?></td>
                        <td><?php echo $propietario->nif; ?></td>
                        <td><?php echo $propietario->nombre_provincia; ?></td>
                        <td><?php echo $propietario->nombre_poblacion; ?></td>
                        <td><?php echo $propietario->direccion; ?></td>
                        <td><?php echo $propietario->telefonos; ?></td>
                        <td><?php echo $propietario->correo; ?></td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("inmuebles/edit/" . $propietario->id); ?>" title="Editar inmueble">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red borrar-propiedad" data-inmueble="<?php echo $propietario->id; ?>" href="#" title="Desasignar">
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
                                            <a href="<?php echo site_url("inmuebles/edit/" . $propietario->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar inmueble">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-propiedad" data-inmueble="<?php echo $propietario->id; ?>" data-rel="tooltip" title="Desasignar">
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
    </div>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">   
    jQuery(function ($) {
        $('.borrar-propiedad').click(function () {
            var cliente = $(this).data("cliente");
            bootbox.confirm("¿Estás seguro/a de quitar al propietario de este inmueble?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url('inmuebles/quitar_cliente/'.$element->id); ?>/' + cliente;
                }
            });
        });
    })
</script>