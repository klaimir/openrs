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
                            <span id="clientes_altas_selected"><?php echo $anio_actual; ?></span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>
                        <?php 
                        if(count($dropdown_anios_clientes)>1) {                             
                        ?>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <?php
                            foreach($dropdown_anios_clientes as $anio)
                            {
                            ?>
                                <li>
                                    <a data-anio="<?php echo $anio; ?>" href="#clientes_altas" class="clientes_altas">
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
                <a name="clientes_altas"></a>
                <div class="widget-main" style="height: 223px;">
                    <div id="plot_clientes_altas"></div>
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
                            <span id="clientes_estados_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#clientes_estados" class="clientes_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="clientes_estados" href="#clientes_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="clientes_estados" href="#clientes_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”clientes_estados”></a>
                <div class="widget-main">
                    <div id="piechart_clientes_estados"></div>
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
                    Medios de Captación
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="clientes_medios_captacion_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#clientes_medios_captacion" class="clientes_medios_captacion">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="clientes_medios_captacion" href="#clientes_medios_captacion">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="clientes_medios_captacion" href="#clientes_medios_captacion">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”clientes_medios_captacion”></a>
                <div class="widget-main">
                    <div id="piechart_clientes_medios_captacion"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->

    <div class="col-lg-6 col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Intereses
                </h5>
                
                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="clientes_tipo_intereses_selected">Interés Vigente</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" data-tipo="tipo_interes_id" data-texto="Interés Vigente" href="#intereses" class="clientes_intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Interés Vigente
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" data-tipo="tipo_interes_id" data-texto="Interés Histórico" class="clientes_intereses" href="#intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Interés Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="-1" data-tipo="tipo_interes_id" data-texto="Interés Indiferente" class="clientes_intereses" href="#intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Interés Indiferente
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="clientes_estado_intereses_selected">Estado Cliente Vigente</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" data-tipo="estado_id" data-texto="Estado Cliente Vigente" href="#intereses" class="clientes_intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Estado Cliente Vigente
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" data-tipo="estado_id" data-texto="Estado Cliente Histórico" class="clientes_intereses" href="#intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Estado Cliente Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" data-tipo="estado_id" data-texto="Cualquier Estado" class="clientes_intereses" href="#intereses">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Cualquier Estado
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="estado_id" id="estado_id" value="0">
            <input type="hidden" name="tipo_interes_id" id="tipo_interes_id" value="0">

            <div class="widget-body">
                <a name=”intereses”></a>
                <div class="widget-main">
                    <div id="piechart_clientes_intereses"></div>
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
                    Agentes asignados
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="clientes_agentes_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#clientes_agentes" class="clientes_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="clientes_agentes" href="#clientes_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="clientes_agentes" href="#clientes_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <a name=”clientes_agentes”></a>
                <div class="widget-main">
                    <div id="piechart_clientes_agentes"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->   
        
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-building"></i>
                    Últimos Registrados
                </h5>                
            </div>
        </div><!-- /.widget-box -->    
        
        <?php $this->data['elements']=$ultimos_clientes_registrados; $this->load->view('clientes/list_buscador', $this->data); ?>
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
        </div><!-- /.widget-box -->    
        
        <?php $this->data['elements']=$ultimos_clientes_modificados; $this->data['show_fecha_modificacion']=TRUE; $this->load->view('clientes/list_buscador', $this->data); ?>
    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        
        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = 'clientes/delete/' + id;
                }
            });
        });
        
        // Plot altas
        var placeholder = $('#plot_clientes_altas').css({'width': '100%', 'height': '180px'});
        var data = <?php echo json_encode($clientes_altas); ?>;
        drawPlot(placeholder, 'Altas', data);        
        drawTootipPlot(placeholder);
        
        $('.clientes_altas').on('click', function () {
            var anio = $(this).data('anio');
            $.ajax({
                url: '<?php echo site_url('estadisticas/altas_clientes/' . $personal . '/'); ?>' + anio,
                success: function (data) {
                    // Texto
                    $('#clientes_altas_selected').html(anio);
                    // Respuesta
                    if (data == 1)
                    {
                        $('#plot_clientes_altas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#plot_clientes_altas').css({'width': '100%', 'height': '180px'});
                        drawPlot(placeholder, 'Altas', JSON.parse(data));
                        drawTootipPlot(placeholder);
                    }
                }
            });
        });

        // Plot estados
        var num_clientes_estados = <?php echo count($clientes_estados); ?>;
        if (num_clientes_estados > 0)
        {
            var placeholder = $('#piechart_clientes_estados').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($clientes_estados); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_clientes_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.clientes_estados').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/estados_clientes/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#clientes_estados_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#clientes_estados_selected').html('Histórico');
                    }
                    else
                    {
                        $('#clientes_estados_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_clientes_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_clientes_estados').css({'width': '90%', 'height': '200px'});
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
            var num_clientes_agentes = <?php echo count($clientes_agentes); ?>;
            if (num_clientes_agentes > 0)
            {
                var placeholder = $('#piechart_clientes_agentes').css({'width': '90%', 'height': '200px'});
                var data = <?php echo json_encode($clientes_agentes); ?>;
                drawPieChart(placeholder, data);
                drawTootip(placeholder);
            }
            else
            {
                $('#piechart_clientes_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
            }

            $('.clientes_agentes').on('click', function () {
                var agente_consulta = $(this).data('valor');
                $.ajax({
                    url: '<?php echo site_url('estadisticas/agentes_clientes/'); ?>' + agente_consulta,
                    success: function (data) {
                        // Texto
                        if (agente_consulta == 0)
                        {
                            $('#clientes_agentes_selected').html('Vigentes');
                        }
                        else if (agente_consulta == 1)
                        {
                            $('#clientes_agentes_selected').html('Histórico');
                        }
                        else
                        {
                            $('#clientes_agentes_selected').html('Todas');
                        }
                        // Respuesta
                        if (data == 1)
                        {
                            $('#piechart_clientes_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                        }
                        else
                        {
                            var placeholder = $('#piechart_clientes_agentes').css({'width': '90%', 'height': '200px'});
                            drawPieChart(placeholder, JSON.parse(data));
                            drawTootip(placeholder);
                        }
                    }
                });
            });
        }
        
        // Plot medios_captacion
        var num_clientes_medios_captacion = <?php echo count($clientes_medios_captacion); ?>;
        if (num_clientes_medios_captacion > 0)
        {
            var placeholder = $('#piechart_clientes_medios_captacion').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($clientes_medios_captacion); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_clientes_medios_captacion').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.clientes_medios_captacion').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/medios_captacion_clientes/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#clientes_medios_captacion_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#clientes_medios_captacion_selected').html('Histórico');
                    }
                    else
                    {
                        $('#clientes_medios_captacion_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_clientes_medios_captacion').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_clientes_medios_captacion').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

        // Plot intereses
        var num_clientes_intereses = <?php echo count($clientes_intereses); ?>;
        if (num_clientes_intereses > 0)
        {
            var placeholder = $('#piechart_clientes_intereses').css({'width': '90%', 'height': '200px'});
            var data = <?php echo json_encode($clientes_intereses); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_clientes_intereses').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.clientes_intereses').on('click', function () {
            var tipo_consulta = $(this).data('tipo');
            // Determinamos tipo de consulta
            if(tipo_consulta=='estado_id')
            {
                var estado_id = $(this).data('valor');
                $('#estado_id').val(estado_id);
                var tipo_interes = $('#tipo_interes_id').val();
            }
            else
            {
                var tipo_interes = $(this).data('valor');
                $('#tipo_interes_id').val(tipo_interes);
                var estado_id = $('#estado_id').val();
            }
            
            var texto=$(this).data('texto');
            
            $.ajax({
                url: '<?php echo site_url('estadisticas/intereses_clientes/' . $personal . '/'); ?>' + estado_id + '/' + tipo_interes,
                success: function (data) {
                    // Texto
                    if(tipo_consulta=='estado_id')
                    {
                        $('#clientes_estado_intereses_selected').html(texto);
                    }
                    else
                    {
                        $('#clientes_tipo_intereses_selected').html(texto);
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_clientes_intereses').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_clientes_intereses').css({'width': '90%', 'height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

    })
</script>