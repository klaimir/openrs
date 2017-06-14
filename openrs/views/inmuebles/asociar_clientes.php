<?php menu_inmuebles ($element->id,"inmuebles"); ?>

<div class="page-header">
    <h1>
        Datos del inmueble
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Asociar clientes
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
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($clientes_disponibles)
                {
                    foreach ($clientes_disponibles as $cliente)
                    {
                    ?>
                    <tr>
                        <td>                        
                            <label>
                                <input class="ace" type="checkbox" value="<?php echo $cliente->id;?>"  name="clientes[]"/>
                                <span class="lbl"></span>
                            </label>
                        </td>
                        <td><?php echo $cliente->apellidos.", ".$cliente->nombre; ?></td>
                        <td><?php echo $cliente->nif; ?></td>
                        <td><?php echo $cliente->nombre_provincia; ?></td>
                        <td><?php echo $cliente->nombre_poblacion; ?></td>
                        <td><?php echo $cliente->direccion; ?></td>
                        <td><?php echo $cliente->telefonos; ?></td>
                        <td><?php echo $cliente->correo; ?></td>                      
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
            Asociar clientes
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