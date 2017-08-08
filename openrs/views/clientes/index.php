<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Clientes
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<?php $this->load->view('clientes/buscador', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/insert'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> <?php echo lang('common_btn_insert'); ?> </span>
        </a>
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/import'); ?>">
            <i class="menu-icon fa fa-upload"></i>
            <span class="menu-text"> Importar CSV </span>
        </a>
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/export'); ?>">
            <i class="menu-icon fa fa-download"></i>
            <span class="menu-text"> Exportar CSV </span>
        </a>        
        <a class="btn btn-info pull-right" id="busqueda_avanzada">
            <i class="menu-icon fa fa-search"></i>
            <span class="menu-text"> Búsqueda Avanzada </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid_clientes">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Fecha alta</th>
                    <th>Ofe.</th>
                    <th>Dem.</th>
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
                        <td><?php echo $element->apellidos.", ".$element->nombre; ?></td>
                        <td><?php echo $element->nif; ?></td>
                        <td><?php echo $element->nombre_provincia; ?></td>
                        <td><?php echo $element->nombre_poblacion; ?></td>
                        <td><?php echo $element->direccion; ?></td>
                        <td><?php echo $element->telefonos; ?></td>
                        <td><?php echo $element->correo; ?></td>
                        <td><?php echo $this->utilities->cambiafecha_bd($element->fecha_alta); ?></td>
                        <td><?php echo $element->num_propiedades; ?></td>
                        <td><?php echo $element->num_inmuebles_demandados; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url($_controller."/edit/" . $element->id); ?>" title="Editar">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                                
                                <a class="blue" href="<?php echo site_url($_controller."/duplicar/" . $element->id); ?>" title="Duplicar">
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
                                            <a href="<?php echo site_url($_controller."/edit/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
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
                                            <a href="<?php echo site_url($_controller."/duplicar/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Duplicar">
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

<!-- inline scripts related to this page -->
<script type="text/javascript">
    function reset_form() {
        $('#pais_id').val('-1');
        $('#estado_id').val('-1');
        $('#provincia_id').val('-1');
        $('#poblacion_id').val('');
        $('#agente_asignado_id').val('-1');
        $('#interes_id').val('-1');
        $('#tipo_interes_id').val('-1');
        $('#fecha_desde').val('');
        $('#fecha_hasta').val('');
        // Resetear los valores no es suficiente para los chosen select, hay que hacer esto tb
        $('.chosen-single').html('<span>- Seleccione -</span><div><b></b></div>');
        return false;
    }    
    
    <?php
    if(isset($filtros['provincia_id']) && $filtros['provincia_id']!="-1")
    {
        if(isset($filtros['poblacion_id']) && $filtros['poblacion_id']!="")
        {
    ?>
            $('#poblaciones').load('<?php echo site_url("common/load_poblaciones/".$filtros['provincia_id']."/".$filtros['poblacion_id']); ?>');
    <?php
        }
        else
        {
    ?>
            $('#poblaciones').load('<?php echo site_url("common/load_poblaciones/".$filtros['provincia_id']); ?>');
    <?php
        }
    }                
    ?>
    
    jQuery(function ($) {

        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url($_controller); ?>/delete/' + id;
                }
            });
        });
        
        $('#busqueda_avanzada').click(function () {
            $('#buscador').toggle('slow');    
            
            $('.chosen-select').each(function() {
                                         var $this = $(this);
                                         $this.next().css({'width': 400 });
                                });
        });
        
        $('#tabgrid_clientes').dataTable({
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
                {"sType": "date-euro"},
                null,
                null,
                null
            ]
        });
    })
</script>