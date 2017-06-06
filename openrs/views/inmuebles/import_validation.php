<div class="page-header">
    <h1>
        Clientes
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Validación Importación CSV
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/import'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Importar Otro CSV </span>
        </a>
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller.'/do_import'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Importar Válidos </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid_import_validation">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Municipio</th>
                    <th>Zona</th>
                    <th>Dirección</th>
                    <th>Precio Compra</th>
                    <th>Precio Alquiler</th>
                    <th>Metros</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Observaciones</th>
                    <th>Otros errores encontrados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($elements)
                {
                    foreach ($elements as $element)
                    {
                    ?>
                    <tr <?php if ($element['error']) echo 'class="danger"'; ?>>
                        <td><?php echo $element['nombre_tipo']; ?></td>                            
                        <td><?php echo $element['nombre_poblacion']; ?></td>
                        <td><?php echo $element['nombre_zona']; ?></td>
                        <td><?php echo $element['direccion']; ?></td>
                        <td><?php echo $element['precio_compra']; ?></td>
                        <td><?php echo $element['precio_alquiler']; ?></td>
                        <td><?php echo $element['metros']; ?></td>
                        <td><?php echo $element['habitaciones']; ?></td>
                        <td><?php echo $element['banios']; ?></td>
                        <td><?php echo $element['observaciones']; ?></td>
                        <td><?php echo $element['texto_errores']; ?></td>
                    </tr>
                <?php 
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php echo form_close(); ?>

<script>
    $(document).ready(function () {
        $('#tabgrid_import_validation').dataTable({
            "iDisplayLength": 100,
            "oLanguage": {"sUrl": "<?php echo base_url('assets/admin/js/dataTables.spanish.txt'); ?>"},
            "aoColumns": [
                null,                
                null,
                {"sType": "date-euro"},
                null,
                null,
                null,
                null,
                null,
                null,
                null,
                null
            ]
        });
    });
</script>