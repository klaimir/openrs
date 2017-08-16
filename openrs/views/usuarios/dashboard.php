<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Inicio
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Estadísticas <?php echo $texto_titulo; ?> (<?php if($personal) { ?>- <a href="<?php echo site_url('usuarios/dashboard/0'); ?>" class="blue">Ver Generales</a> -<?php } else { ?>- <a href="<?php echo site_url('usuarios/dashboard/1'); ?>" class="blue">Ver Personales</a> -<?php } ?>)
                </small>
            </h1>
        </div>
    </div>
</div>
<!-- inline scripts related to this page -->
<script type="text/javascript">
        
        function drawTootip(placeholder) {
            //pie chart tooltip example
            var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
            var previousPoint = null;

            placeholder.on('plothover', function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.seriesIndex) {
                        previousPoint = item.seriesIndex;
                        var tip = item.series['label'] + " : " + Math.round(item.series['percent']) + '%';
                        $tooltip.show().children(0).text(tip);
                    }
                    $tooltip.css({top: pos.pageY + 10, left: pos.pageX + 10});
                } else {
                    $tooltip.hide();
                    previousPoint = null;
                }

            });
        }
        
        function drawPieChart(placeholder, data, position) {
            $.plot(placeholder, data, {
                series: {
                    pie: {
                        show: true,
                        tilt: 0.8,
                        highlight: {
                            opacity: 0.25
                        },
                        stroke: {
                            color: '#fff',
                            width: 2
                        },
                        startAngle: 2
                    }
                },
                legend: {
                    show: true,
                    position: position || "ne",
                    labelBoxBorderColor: null,
                    margin: [-30, 15]
                }
                ,
                grid: {
                    hoverable: true,
                    clickable: true
                }
            })
        }
</script>

<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_inmuebles" data-toggle="tab">INMUEBLES</a></li>
        <li><a href="#tab_clientes" data-toggle="tab">CLIENTES</a></li>
        <li><a href="#tab_demandas" data-toggle="tab">DEMANDAS</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_inmuebles">
            <?php $this->load->view('estadisticas/inmuebles', $this->data); ?>
        </div>
        <div class="tab-pane" id="tab_clientes">
            <?php //$this->load->view('estadisticas/clientes', $this->data); ?>
        </div>
        <div class="tab-pane" id="tab_demandas">
            <?php //$this->load->view('estadisticas/demandas', $this->data); ?>
        </div>
    </div>    
</div>