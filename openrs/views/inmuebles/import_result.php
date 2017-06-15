<div class="page-header">
    <h1>
        Inmuebles
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Resultado Importación CSV
        </small>
    </h1>
</div>

<?php $this->load->view('common/message', $this->data); ?> 

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller . '/import'); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> Importar Otro CSV </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid_import_result">
            <thead>
                <tr>
                    <th>Referencia</th>
                    <th>Tipo</th>
                    <th>Fecha Alta</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Zona</th>
                    <th>Dirección</th>
                    <th>Metros</th>
                    <th>Metros útiles</th>
                    <th>Hab.</th>
                    <th>Baños</th>
                    <th>Precio Compra</th>
                    <th>Precio Alquiler</th>
                    <th>Cert. Energ.</th>
                    <th>Año Construcción</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($elements) && $elements)
                {
                    foreach ($elements as $element)
                    {
                        ?>
                        <tr <?php if ($element['importado']) echo 'class="success"'; else echo 'class="danger"'; ?>>
                            <td><?php echo $element['referencia']; ?></td>  
                            <td><?php echo $element['nombre_tipo']; ?></td>    
                            <td><?php echo $element['fecha_alta']; ?></td>
                            <td><?php echo $element['nombre_provincia']; ?></td>
                            <td><?php echo $element['nombre_poblacion']; ?></td>
                            <td><?php echo $element['nombre_zona']; ?></td>
                            <td><?php echo $element['direccion']; ?></td>
                            <td><?php echo $element['metros']; ?></td>
                            <td><?php echo $element['metros_utiles']; ?></td>
                            <td><?php echo $element['habitaciones']; ?></td>
                            <td><?php echo $element['banios']; ?></td>
                            <td><?php echo $element['precio_compra']; ?></td>
                            <td><?php echo $element['precio_alquiler']; ?></td>
                            <td><?php echo $element['nombre_certificacion_energetica']; ?></td>
                            <td><?php echo $element['anio_construccion']; ?></td>
                            <td><?php echo $element['nombre_estado']; ?></td>
                            <td><?php echo $element['observaciones']; ?></td>
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
        $('#tabgrid_import_result').dataTable({
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