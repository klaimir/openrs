<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Demandas
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<?php $this->load->view('demandas/buscador', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/insert'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> <?php echo lang('common_btn_insert'); ?> </span>
        </a>
        <?php /*
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/import'); ?>">
            <i class="menu-icon fa fa-upload"></i>
            <span class="menu-text"> Importar CSV </span>
        </a>
         * 
         */ 
        ?>
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
        <?php $this->data['tabgrid']='tabgrid_demandas'; $this->load->view('demandas/list_buscador', $this->data); ?>
    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    function reset_form() {
        $('#tipo_id').val('-1');
        $('#certificacion_energetica_id').val('-1');
        $('#estado_id').val('-1');
        $('#provincia_id').val('-1');
        $('#poblacion_id').val('');
        $('#zona_id').val('');
        $('#agente_asignado_id').val('-1');
        $('#cliente_id').val('-1');
        $('#oferta_id').val('-1');   
        $('#tipo_demanda_id').val('-1');  
        $('#fecha_desde').val('');
        $('#fecha_hasta').val('');
        $('#banios_desde').val('');
        $('#banios_hasta').val('');
        $('#habitaciones_desde').val('');
        $('#habitaciones_hasta').val('');
        $('#metros_desde').val('');
        $('#metros_hasta').val('');
        $('#precios_desde').val('');
        $('#precios_hasta').val('');
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
        
    <?php
    if(isset($filtros['poblacion_id']) && $filtros['poblacion_id']!="-1" && $filtros['poblacion_id']!="")
    {
        if(isset($filtros['zona_id']) && $filtros['zona_id']!="")
        {
    ?>
            $('#zonas').load('<?php echo site_url("common/load_zonas/".$filtros['poblacion_id']."/".$filtros['zona_id']); ?>');
    <?php
        }
        else
        {
    ?>
            $('#zonas').load('<?php echo site_url("common/load_zonas/".$filtros['poblacion_id']); ?>');
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
                null,
                {"sType": "date-euro"},
                null,
                null,
                null
            ]
        });
    })
</script>