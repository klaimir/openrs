<div class="page-header">
    <h1>
        Clientes
        <small>
            <i class="ace-icon fa fa-angle-double-right"></i>
            Resultado Importación CSV
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
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12" style="overflow-y:auto">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Nombre Completo</th>
                    <th>CIF/NIE/NIF</th>
                    <th>País Residencia</th>
                    <th>Provincia</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>E-mail</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($elements) && $elements)
                {
                    foreach ($elements as $element)
                    {
                    ?>
                    <tr <?php if ($element['importado']) echo 'class="success"'; else echo 'class="danger"'; ?>>
                        <td><?php echo $element['apellidos'].", ".$element['nombre']; ?></td>
                        <td><?php echo $element['nif']; ?></td>
                        <td><?php echo $element['nombre_pais']; ?></td>
                        <td><?php echo $element['nombre_provincia']; ?></td>
                        <td><?php echo $element['nombre_poblacion']; ?></td>
                        <td><?php echo $element['direccion']; ?></td>
                        <td><?php echo $element['telefonos']; ?></td>
                        <td><?php echo $element['correo']; ?></td>
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