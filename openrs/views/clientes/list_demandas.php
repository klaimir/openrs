<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url('demandas/insert?cliente_id='.$element->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Crear Demanda </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <?php
        if($element->inmuebles_demandados)
        {
        ?>
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Ref. Demanda</th>
                    <th>Ref. Inmueble</th>
                    <th>Tipología</th>
                    <th>Municipio</th>
                    <th>Zona</th>
                    <th>Dirección</th>
                    <th>Precio Compra</th>
                    <th>Precio Alquiler</th>
                    <th>Metros</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Ficha visita</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($element->inmuebles_demandados as $inmueble)
                    {
                    ?>
                    <tr>
                        <td><a href="<?php echo site_url("demandas/edit/" . $inmueble->demanda_id); ?>" title="Editar demanda"><?php echo $inmueble->referencia_demanda; ?></a></td>
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
                        <td>-</td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" title="Editar inmueble">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>
                                <a class="red borrar-inmueble" data-demanda="<?php echo $inmueble->demanda_id; ?>" data-inmueble="<?php echo $inmueble->id; ?>" href="#" title="Desasignar">
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
                                            <a href="#" class="tooltip-error borrar-inmueble" data-demanda="<?php echo $inmueble->demanda_id; ?>" data-inmueble="<?php echo $inmueble->id; ?>" data-rel="tooltip" title="Desasignar">
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
            <p><i class="ace-icon fa fa-info-circle"></i> Actualmente no hay inmuebles demandados por el cliente actual</p>
        <?php 
        }
        ?>
    </div>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">   
    jQuery(function ($) {
        $('.borrar-inmueble').click(function () {
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