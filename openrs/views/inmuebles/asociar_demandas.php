<?php menu_inmuebles ($element->id,"inmuebles"); ?>

<div class="page-header">
    <h1>
        Datos del inmueble
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Asociar demandas
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid_demandas">
            <thead>
                <tr>
                    <th>
                        <label>
                            <input class="ace" type="checkbox">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Ref.</th>
                    <th>Cliente</th>
                    <th>Tipos<br>Inmuebles</th>
                    <th>Lugar</th>
                    <th>Precios</th>
                    <th>Metros</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Observaciones</th>
                    <th>Fecha alta</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($demandas_disponibles)
                {
                    foreach ($demandas_disponibles as $demanda)
                    {
                    ?>
                    <tr>
                        <td>                        
                            <label>
                                <input class="ace" type="checkbox" value="<?php echo $demanda->id;?>"  name="demandas[]"/>
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td><?php echo $demanda->referencia; ?></td>
                        <td>
                            <a href="<?php echo site_url("clientes/edit/" . $demanda->id); ?>" class="blue" title="Ver datos del cliente">
                                <?php echo $demanda->nombre_cliente; ?>
                            </a>              
                        </td>
                        <td><?php if($demanda->tipos_inmuebles) { echo $demanda->tipos_inmuebles; } else { echo "-"; } ?></td>
                        <td>
                            <?php
                                echo $demanda->nombre_poblacion;
                                if($demanda->zonas) { echo "<br>(". $demanda->zonas . ")";  }
                             ?>
                        </td>
                        <td><?php echo format_interval(number_format($demanda->precio_desde, 0, ",", "."),number_format($demanda->precio_hasta, 0, ",", ".")); ?></td>
                        <td><?php echo format_interval($demanda->metros_desde,$demanda->metros_hasta); ?></td>
                        <td><?php echo format_interval($demanda->habitaciones_desde,$demanda->habitaciones_hasta); ?></td>
                        <td><?php echo format_interval($demanda->banios_desde,$demanda->banios_hasta); ?></td>
                        <td><?php echo $this->utilities->cortar_texto($demanda->observaciones,50); ?></td>
                        <td><?php echo $this->utilities->cambiafecha_bd($demanda->fecha_alta); ?></td>          
                    </tr>
                <?php 
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button class="btn btn-info" type="submit" name="submit">
            <i class="ace-icon fa fa-check bigger-110"></i>
            Asociar demandas
        </button>
    </div>
</div>

<?php echo form_hidden('id',$element->id); ?>

<?php echo form_close(); ?>

<script type="text/javascript">
    jQuery(function($) {
       show_submenu();
       
       $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function(){
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
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
                {"sType": "date-euro"}
            ]
        });
    })
</script>