<div class="row">
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
                            <span id="inmuebles_estados_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#" class="inmuebles_estados">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="inmuebles_estados" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="inmuebles_estados" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart_inmuebles_estados"></div>

                    <?php /*
                      <div class="hr hr8 hr-double"></div>

                      <div class="clearfix">
                      <div class="grid3">
                      <span class="grey">
                      <i class="ace-icon fa fa-facebook-square fa-2x blue"></i>
                      &nbsp; likes
                      </span>
                      <h4 class="bigger pull-right">1,255</h4>
                      </div>

                      <div class="grid3">
                      <span class="grey">
                      <i class="ace-icon fa fa-twitter-square fa-2x purple"></i>
                      &nbsp; tweets
                      </span>
                      <h4 class="bigger pull-right">941</h4>
                      </div>

                      <div class="grid3">
                      <span class="grey">
                      <i class="ace-icon fa fa-pinterest-square fa-2x red"></i>
                      &nbsp; pins
                      </span>
                      <h4 class="bigger pull-right">1,050</h4>
                      </div>
                      </div>
                     * 
                     */
                    ?>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->
    </div><!-- /.col -->

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
                            <span id="inmuebles_ofertas_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#" class="inmuebles_ofertas">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="inmuebles_ofertas" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="inmuebles_ofertas" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart_inmuebles_ofertas"></div>
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
                    Tipo
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="inmuebles_tipos_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#" class="inmuebles_tipos">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="inmuebles_tipos" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="inmuebles_tipos" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart_inmuebles_tipos"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->

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
                            <span id="inmuebles_altas_selected"><?php echo $anio_actual; ?></span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>
                        <?php 
                        if(count($dropdown_anios)>1) {                             
                        ?>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <?php
                            foreach($dropdown_anios as $anio)
                            {
                            ?>
                                <li>
                                    <a data-anio="<?php echo $anio; ?>" href="#" class="inmuebles_altas">
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
                <div class="widget-main">
                    <div id="plot_inmuebles_altas"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->
</div><!-- /.row -->

<?php if(!$personal) { ?>
<div class="row">
    <div class="col-xs-12">

        <div class="widget-box">
            <div class="widget-header widget-header-flat widget-header-small">
                <h5 class="widget-title">
                    <i class="ace-icon fa fa-signal"></i>
                    Captadores
                </h5>

                <div class="widget-toolbar no-border">
                    <div class="inline dropdown-hover">
                        <button class="btn btn-minier btn-primary">
                            <span id="inmuebles_agentes_selected">Vigentes</span>
                            <i class="ace-icon fa fa-angle-down icon-on-right bigger-110"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-right dropdown-125 dropdown-lighter dropdown-close dropdown-caret">
                            <li>
                                <a data-valor="0" href="#" class="inmuebles_agentes">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Vigentes
                                </a>
                            </li>

                            <li>
                                <a data-valor="1" class="inmuebles_agentes" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Histórico
                                </a>
                            </li>

                            <li>
                                <a data-valor="2" class="inmuebles_agentes" href="#">
                                    <i class="ace-icon fa fa-caret-right bigger-110 invisible">&nbsp;</i>
                                    Todas
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main">
                    <div id="piechart_inmuebles_agentes"></div>
                </div><!-- /.widget-main -->
            </div><!-- /.widget-body -->

        </div><!-- /.widget-box -->

    </div><!-- /.col -->

</div><!-- /.row -->
<?php } ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        // Plot estados
        var num_inmuebles_estados = <?php echo count($inmuebles_estados); ?>;
        if (num_inmuebles_estados > 0)
        {
            var placeholder = $('#piechart_inmuebles_estados').css({'width': '90%', 'min-height': '200px'});
            var data = <?php echo json_encode($inmuebles_estados); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_inmuebles_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.inmuebles_estados').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/estados_inmuebles/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#inmuebles_estados_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#inmuebles_estados_selected').html('Histórico');
                    }
                    else
                    {
                        $('#inmuebles_estados_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_inmuebles_estados').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_inmuebles_estados').css({'width': '90%', 'min-height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

        // Plot ofertas
        var num_inmuebles_ofertas = <?php echo count($inmuebles_ofertas); ?>;
        if (num_inmuebles_ofertas > 0)
        {
            var placeholder = $('#piechart_inmuebles_ofertas').css({'width': '90%', 'min-height': '200px'});
            var data = <?php echo json_encode($inmuebles_ofertas); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_inmuebles_ofertas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.inmuebles_ofertas').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/ofertas_inmuebles/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#inmuebles_ofertas_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#inmuebles_ofertas_selected').html('Histórico');
                    }
                    else
                    {
                        $('#inmuebles_ofertas_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_inmuebles_ofertas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_inmuebles_ofertas').css({'width': '90%', 'min-height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

        // Plot tipos
        var num_inmuebles_tipos = <?php echo count($inmuebles_tipos); ?>;
        if (num_inmuebles_tipos > 0)
        {
            var placeholder = $('#piechart_inmuebles_tipos').css({'width': '90%', 'min-height': '200px'});
            var data = <?php echo json_encode($inmuebles_tipos); ?>;
            drawPieChart(placeholder, data);
            drawTootip(placeholder);
        }
        else
        {
            $('#piechart_inmuebles_tipos').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
        }

        $('.inmuebles_tipos').on('click', function () {
            var tipo_consulta = $(this).data('valor');
            $.ajax({
                url: '<?php echo site_url('estadisticas/tipos_inmuebles/' . $personal . '/'); ?>' + tipo_consulta,
                success: function (data) {
                    // Texto
                    if (tipo_consulta == 0)
                    {
                        $('#inmuebles_tipos_selected').html('Vigentes');
                    }
                    else if (tipo_consulta == 1)
                    {
                        $('#inmuebles_tipos_selected').html('Histórico');
                    }
                    else
                    {
                        $('#inmuebles_tipos_selected').html('Todas');
                    }
                    // Respuesta
                    if (data == 1)
                    {
                        $('#piechart_inmuebles_tipos').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#piechart_inmuebles_tipos').css({'width': '90%', 'min-height': '200px'});
                        drawPieChart(placeholder, JSON.parse(data));
                        drawTootip(placeholder);
                    }
                }
            });
        });

        // Plot altas
        var placeholder = $('#plot_inmuebles_altas').css({'width': '100%', 'min-height': '200px'});
        var data = <?php echo json_encode($inmuebles_altas); ?>;
        drawPlot(placeholder, 'Altas', data);        
        drawTootipPlot(placeholder);
        
        $('.inmuebles_altas').on('click', function () {
            var anio = $(this).data('anio');
            $.ajax({
                url: '<?php echo site_url('estadisticas/altas_inmuebles/' . $personal . '/'); ?>' + anio,
                success: function (data) {
                    // Texto
                    $('#inmuebles_altas_selected').html(anio);
                    // Respuesta
                    if (data == 1)
                    {
                        $('#plot_inmuebles_altas').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                    }
                    else
                    {
                        var placeholder = $('#plot_inmuebles_altas').css({'width': '100%', 'min-height': '200px'});
                        drawPlot(placeholder, 'Altas', JSON.parse(data));
                        drawTootipPlot(placeholder);
                    }
                }
            });
        });
        
        // Plot agentes
        var personal=<?php echo $personal; ?>
        // La estadística de agente sólo es general
        if(!personal)
        {
            var num_inmuebles_agentes = <?php echo count($inmuebles_agentes); ?>;
            if (num_inmuebles_agentes > 0)
            {
                var placeholder = $('#piechart_inmuebles_agentes').css({'width': '90%', 'min-height': '200px'});
                var data = <?php echo json_encode($inmuebles_agentes); ?>;
                drawPieChart(placeholder, data);
                drawTootip(placeholder);
            }
            else
            {
                $('#piechart_inmuebles_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
            }

            $('.inmuebles_agentes').on('click', function () {
                var agente_consulta = $(this).data('valor');
                $.ajax({
                    url: '<?php echo site_url('estadisticas/agentes_inmuebles/'); ?>' + agente_consulta,
                    success: function (data) {
                        // Texto
                        if (agente_consulta == 0)
                        {
                            $('#inmuebles_agentes_selected').html('Vigentes');
                        }
                        else if (agente_consulta == 1)
                        {
                            $('#inmuebles_agentes_selected').html('Histórico');
                        }
                        else
                        {
                            $('#inmuebles_agentes_selected').html('Todas');
                        }
                        // Respuesta
                        if (data == 1)
                        {
                            $('#piechart_inmuebles_agentes').html('<p><i class="ace-icon fa fa-info-circle"></i> No hay datos para mostrar con el criterio seleccionado </p>');
                        }
                        else
                        {
                            var placeholder = $('#piechart_inmuebles_agentes').css({'width': '90%', 'min-height': '200px'});
                            drawPieChart(placeholder, JSON.parse(data));
                            drawTootip(placeholder);
                        }
                    }
                });
            });
        }

    })
</script>