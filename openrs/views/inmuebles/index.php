<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Inmuebles
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<?php $this->load->view('inmuebles/buscador', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <?php if($elements) { ?>
            <a class="btn btn-info pull-right" onclick="check_multiple_google_maps('private');">
                <i class="menu-icon fa fa-map-marker"></i>
                <span class="menu-text"> Ver mapa real</span>
            </a>
        <a class="btn btn-info pull-right" onclick="check_multiple_google_maps('public');">
                <i class="menu-icon fa fa-map-marker"></i>
                <span class="menu-text"> Ver mapa público</span>
            </a>
        <?php } ?>
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

<div class="row" id="google_maps_div" style="display:none;">      
    <div class="space-10"></div>
    <div class="col-xs-12">
        <div id="google_maps">
        </div>
        <small class="blue">El mapa está cargándose, espere unos segundos... Aparecerá centrado en la provincia o población seleccionado en su criterio de búsqueda. Si no seleccionó ninguna de las dos, entonces se centrará en su posición actual. Esta opción sólo funcionará si tiene habilitado en su dispositivo la geolocalización y no está bloqueado para el navegador web actual.</small>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <?php $this->data['tabgrid']='tabgrid'; $this->load->view('inmuebles/list_buscador', $this->data); ?>
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
        $('#captador_id').val('-1');
        $('#oferta_id').val('-1');
        $('#modificacion_precio_id').val('-1');   
        $('#publicado_id').val('-1');
        $('#destacado_id').val('-1');
        $('#oportunidad_id').val('-1');
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
            $('#poblaciones').load('<?php echo site_url("inmuebles/load_poblaciones/".$filtros['provincia_id']."/".$filtros['poblacion_id']); ?>');
    <?php
        }
        else
        {
    ?>
            $('#poblaciones').load('<?php echo site_url("inmuebles/load_poblaciones/".$filtros['provincia_id']); ?>');
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
            $('#zonas').load('<?php echo site_url("inmuebles/load_zonas/".$filtros['poblacion_id']."/".$filtros['zona_id']); ?>');
    <?php
        }
        else
        {
    ?>
            $('#zonas').load('<?php echo site_url("inmuebles/load_zonas/".$filtros['poblacion_id']); ?>');
    <?php
        }
    }                
    ?>
        
    function check_multiple_google_maps(infowindow_type) {
        $('#google_maps_div').toggle('slow');
        $('#google_maps').load('<?php echo site_url('inmuebles/multiple_google_map/');?>'+infowindow_type);
    }
    
    jQuery(function ($) {
        
        $('#busqueda_avanzada').click(function () {
            $('#buscador').toggle('slow');    
            /*
            $('.chosen-select').each(function() {
                                         var $this = $(this);
                                         $this.next().css({'width': 400 });
                                });
                                */
        });
        
        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url($_controller); ?>/delete/' + id;
                }
            });
        });
    })
</script>