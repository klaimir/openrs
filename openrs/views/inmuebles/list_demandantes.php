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
        if($element->demandantes)
        {
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Ref. Demanda</th>
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Ficha visita</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($element->demandantes as $demandante)
                    {
                    ?>
                    <tr>
                        <td><a href="<?php echo site_url("demandas/edit/" . $demandante->demanda_id); ?>" title="Editar demanda"><?php echo $demandante->referencia_demanda; ?></a></td>
                        <td><?php echo $demandante->apellidos.", ".$demandante->nombre; ?></td>
                        <td><?php echo $demandante->nif; ?></td>
                        <td><?php echo $demandante->nombre_provincia; ?></td>
                        <td><?php echo $demandante->nombre_poblacion; ?></td>
                        <td><?php echo $demandante->direccion; ?></td>
                        <td><?php echo $demandante->telefonos; ?></td>
                        <td><?php echo $demandante->correo; ?></td>
                        <td>-</td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("clientes/edit/" . $demandante->id); ?>" title="Editar cliente">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red borrar-demanda" data-demanda="<?php echo $demandante->demanda_id; ?>" data-inmueble="<?php echo $demandante->id; ?>" href="#" title="Desasignar">
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
                                            <a href="<?php echo site_url("clientes/edit/" . $demandante->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar cliente">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-demanda" data-demanda="<?php echo $demandante->demanda_id; ?>" data-demanda="<?php echo $demandante->id; ?>" data-rel="tooltip" title="Desasignar">
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
            <p><i class="ace-icon fa fa-info-circle"></i> Actualmente no hay demandantes para el inmueble actual</p>
        <?php 
        }
        ?>
    </div>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">   
    jQuery(function ($) {
        $('.borrar-demanda').click(function () {
            var demanda = $(this).data("demanda");
            var inmueble = $(this).data("inmueble");
            bootbox.confirm("¿Estás seguro/a de quitar la demanda de este inmueble?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url('demandas/quitar_inmueble'); ?>/' + demanda + '/' + inmueble;
                }
            });
        });
    })
</script>