<?php menu_clientes ($element->id,"clientes"); ?>

<div class="page-header">
    <h1>
        Datos del cliente
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Asociar Inmuebles
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>
                        <label>
                            <input class="ace" type="checkbox">
                            <span class="lbl"></span>
                        </label>
                    </th>
                    <th>Referencia</th>
                    <th>Tipología</th>
                    <th>Municipio</th>
                    <th>Zona</th>
                    <th>Dirección</th>
                    <th>Precio<br> Compra</th>
                    <th>Precio<br> Alquiler</th>
                    <th>Metros</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($inmuebles_disponibles)
                {
                    foreach ($inmuebles_disponibles as $inmueble)
                    {
                    ?>
                    <tr>
                        <td>                        
                            <label>
                                <input class="ace" type="checkbox" value="<?php echo $inmueble->id;?>"  name="inmuebles[]"/>
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td>
                            <a href="<?php echo site_url("inmuebles/edit/" . $inmueble->id); ?>" class="blue" title="Editar datos del inmueble">
                                <?php echo $inmueble->referencia; ?>
                            </a>
                        </td>
                        <td><?php echo $inmueble->nombre_tipo; ?></td>
                        <td><?php echo $inmueble->nombre_poblacion; ?></td>
                        <td><?php echo $inmueble->nombre_zona; ?></td>
                        <td><?php echo $inmueble->direccion; ?></td>
                        <td><?php echo number_format($inmueble->precio_compra, 0, ",", "."); ?></td>
                        <td><?php echo number_format($inmueble->precio_alquiler, 0, ",", "."); ?></td>
                        <td><?php echo $inmueble->metros; ?></td>
                        <td><?php echo $inmueble->habitaciones; ?></td>
                        <td><?php echo $inmueble->banios; ?></td>                        
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
            Asociar Inmuebles
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
    })
</script>