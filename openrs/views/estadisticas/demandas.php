<div class="row">
    <div class="col-lg-6 col-xs-12">
        
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Evolución de altas
                </h5>
                
                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_altas_selected"><?php echo $anio_actual; ?></span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>
                        <?php 
                        if(count($dropdown_anios_demandas)>1) {                             
                        ?>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <?php
                            foreach($dropdown_anios_demandas as $anio)
                            {
                            ?>
                                <li>
                                    <a data-anio="<?php echo $anio; ?>" href="#demandas_altas" class="demandas_altas">
                                        <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                        <?php echo $anio; ?>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name="demandas_altas"></a>
                <div class="widget-main" style="height: 223px;">
                    <div id="plot_demandas_altas"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
    
    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Estados
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_estados_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_estados" class="demandas_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_estados" href="#demandas_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_estados" href="#demandas_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_estados”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_estados"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->
    </div><!-- /.col -->
    
</div><!-- /.row -->

<div class="row">
    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Ofertas
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_ofertas_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_ofertas" class="demandas_ofertas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_ofertas" href="#demandas_ofertas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_ofertas" href="#demandas_ofertas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_ofertas”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_ofertas"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
    
    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Tipos de Demanda
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_tipos_demandas_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_tipos_demandas" class="demandas_tipos_demandas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_tipos_demandas" href="#demandas_tipos_demandas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_tipos_demandas" href="#demandas_tipos_demandas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_tipos_demandas”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_tipos_demandas"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">    
    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Tipos de Inmuebles
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_tipos_inmuebles_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_tipos_inmuebles" class="demandas_tipos_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_tipos_inmuebles" href="#demandas_tipos_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_tipos_inmuebles" href="#demandas_tipos_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_tipos_inmuebles”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_tipos_inmuebles"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
    
    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Estado de Evaluación de Inmuebles
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_evaluacion_inmuebles_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_evaluacion_inmuebles" class="demandas_evaluacion_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_evaluacion_inmuebles" href="#demandas_evaluacion_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_evaluacion_inmuebles" href="#demandas_evaluacion_inmuebles">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_evaluacion_inmuebles”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_evaluacion_inmuebles"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
</div><!-- /.row -->

<?php if(!$personal) { ?>
<div class="row">    
    <div class="col-lg-6 col-xs-12">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Agentes Asignados
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="demandas_agentes_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#demandas_agentes" class="demandas_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="demandas_agentes" href="#demandas_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="demandas_agentes" href="#demandas_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”demandas_agentes”></a>
                <div class="widget-main">
                    <div id="piechart_demandas_agentes"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->   
        
    </div>
</div>
<?php } ?>
<?php if($show_lists) { ?>
<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-building"></i>
                    Últimos Registrados
                </h5>                
            </div>
        </div>
        <?php 
        if(count($ultimos_demandas_registrados)>0)
        {
            $this->data['elements']=$ultimos_demandas_registrados; $this->data['show_fecha_modificacion']=FALSE;
            $this->load->view('demandas/list_buscador', $this->data);
        }
        else
        {
            echo '<div class="space-10"></div><p><i class="ace-icon fa fa-info-circle"></i> No hay demandas registradas con los criterios seleccionados </p>';
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-building"></i>
                    Últimos modificados
                </h5>                
            </div>
        </div>
        <?php 
        if(count($ultimos_demandas_modificados)>0)
        {
            $this->data['elements']=$ultimos_demandas_modificados; $this->data['show_fecha_modificacion']=TRUE; 
            $this->load->view('demandas/list_buscador', $this->data); 
        }
        else
        {
            echo '<div class="space-10"></div><p><i class="ace-icon fa fa-info-circle"></i> No hay demandas modificadas con los criterios seleccionados </p>';
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-building"></i>
                    Demandas con inmuebles pendientes de evaluar
                </h5>                
            </div>
        </div>
        <?php 
        if(count($demandas_pendientes_evaluar)>0)
        {
            $this->data['elements']=$demandas_pendientes_evaluar; $this->data['show_fecha_modificacion']=FALSE;  $this->data['ocultar_datos_adicionales']=TRUE; 
            $this->load->view('demandas/list_buscador', $this->data); 
        }
        else
        {
            echo '<div class="space-10"></div><p><i class="ace-icon fa fa-info-circle"></i> No hay demandas con inmuebles pendientes de evaluar con los criterios seleccionados </p>';
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-building"></i>
                    Demandas con inmuebles propuestos para visita
                </h5>                
            </div>
        </div>
        <?php 
        if(count($demandas_propuestos_visita)>0)
        {
            $this->data['elements']=$demandas_propuestos_visita; $this->data['show_fecha_modificacion']=FALSE;  $this->data['ocultar_datos_adicionales']=TRUE; 
            $this->load->view('demandas/list_buscador', $this->data); 
        }
        else
        {
            echo '<div class="space-10"></div><p><i class="ace-icon fa fa-info-circle"></i> No hay demandas con inmuebles propuestos para visita con los criterios seleccionados </p>';
        }
        ?>
    </div>
</div>
<?php } ?>
<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = 'demandas/delete/' + id;
                }
            });
        });
        
        // Plot altas
        var placeholder = $('#plot_demandas_altas').css({'width': '100%', 'height': '180px'});
        var data = <?php echo json_encode($demandas_altas); ?>;
        drawPlot(placeholder, 'Altas', data);        
        drawTootipPlot(placeholder);
        
        $('.demandas_altas').on('click', function () {
            var anio = $(this).data('anio');
            $.ajax({
                url: '<?php echo site_url('estadisticas/altas_demandas/' . $personal . '/'); ?>' + anio,
                success: function (data) {
                    // Texto
                    $('#demandas_altas_selected').html(anio);
                    // Respuesta
                    if (data == 1)
                    {
                        $('#plot_demandas_altas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#plot_demandas_altas').css({'width': '100%', 'height': '180px'});
                        drawPlot(placeholder, 'Altas', JSON.parse(data));
                        drawTootipPlot(placeholder);
                    }
                }
            });
        });

        // Plot estados
        var num_demandas_estados = <?php echo count($demandas_estados); ?>;
        if (num_demandas_estados > 0)
        {
            var placeholder = $('#piechart_demandas_estados').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($demandas_estados); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_demandas_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.demandas_estados').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/estados_demandas/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#demandas_estados_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#demandas_estados_selected').html('Histórico');
                    }
                    else
                    {
                        $('#demandas_estados_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_demandas_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_demandas_estados').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });
        
        // Plot agentes
        var personal=<?php echo $personal; ?>
        // La estadística de agente sólo es general
        if(!personal)
        {
            var num_demandas_agentes = <?php echo count($demandas_agentes); ?>;
            if (num_demandas_agentes > 0)
            {
                var placeholder = $('#piechart_demandas_agentes').css({'width': '90%', 'height': '200px'});
                var data = <?php echo json_encode($demandas_agentes); ?>;
                drawPieChart(placeholder, data);
                drawTootip(placeholder);
            }
            else
            {
                $('#piechart_demandas_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
            }

            $('.demandas_agentes').on('click', function () {
                var agente_consulta = $(this).data('valor');
                $.ajax({
                    url: '<?php echo site_url('estadisticas/agentes_demandas/'); ?>' + agente_consulta,
                    success: function (data) {
                        // Texto
                        if (agente_consulta == 0)
                        {
                            $('#demandas_agentes_selected').html('Vigentes');
                        }
                        else if (agente_consulta == 1)
                        {
                            $('#demandas_agentes_selected').html('Histórico');
                        }
                        else
                        {
                            $('#demandas_agentes_selected').html('Todas');
                        }
                        // Respuesta
                        if (data == 1)
                        {
                            $('#piechart_demandas_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                        }
                        else
                        {
                            var placeholder = $('#piechart_demandas_agentes').css({'width': '90%', 'height': '200px'});
                            drawPieChart(placeholder, JSON.parse(data));
                            drawTootip(placeholder);
                        }
                    }
                });
            });
        }

        // Plot ofertas
        var num_demandas_ofertas = <?php echo count($demandas_ofertas); ?>;
        if (num_demandas_ofertas > 0)
        {
            var placeholder = $('#piechart_demandas_ofertas').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($demandas_ofertas); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_demandas_ofertas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.demandas_ofertas').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/ofertas_demandas/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#demandas_ofertas_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#demandas_ofertas_selected').html('Histórico');
                    }
                    else
                    {
                        $('#demandas_ofertas_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_demandas_ofertas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_demandas_ofertas').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });
        
        // Plot tipos_demandas
        var num_demandas_tipos_demandas = <?php echo count($demandas_tipos_demandas); ?>;
        if (num_demandas_tipos_demandas > 0)
        {
            var placeholder = $('#piechart_demandas_tipos_demandas').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($demandas_tipos_demandas); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_demandas_tipos_demandas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.demandas_tipos_demandas').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/tipos_demandas_demandas/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#demandas_tipos_demandas_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#demandas_tipos_demandas_selected').html('Histórico');
                    }
                    else
                    {
                        $('#demandas_tipos_demandas_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_demandas_tipos_demandas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_demandas_tipos_demandas').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });
        
        // Plot tipos_inmuebles
        var num_demandas_tipos_inmuebles = <?php echo count($demandas_tipos_inmuebles); ?>;
        if (num_demandas_tipos_inmuebles > 0)
        {
            var placeholder = $('#piechart_demandas_tipos_inmuebles').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($demandas_tipos_inmuebles); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_demandas_tipos_inmuebles').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.demandas_tipos_inmuebles').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/tipos_inmuebles_demandas/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#demandas_tipos_inmuebles_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#demandas_tipos_inmuebles_selected').html('Histórico');
                    }
                    else
                    {
                        $('#demandas_tipos_inmuebles_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_demandas_tipos_inmuebles').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_demandas_tipos_inmuebles').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });
        
        // Plot evaluacion_inmuebles
        var num_demandas_evaluacion_inmuebles = <?php echo count($demandas_evaluacion_inmuebles); ?>;
        if (num_demandas_evaluacion_inmuebles > 0)
        {
            var placeholder = $('#piechart_demandas_evaluacion_inmuebles').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($demandas_evaluacion_inmuebles); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_demandas_evaluacion_inmuebles').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.demandas_evaluacion_inmuebles').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/evaluacion_inmuebles_demandas/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#demandas_evaluacion_inmuebles_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#demandas_evaluacion_inmuebles_selected').html('Histórico');
                    }
                    else
                    {
                        $('#demandas_evaluacion_inmuebles_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_demandas_evaluacion_inmuebles').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_demandas_evaluacion_inmuebles').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

    })
</script>