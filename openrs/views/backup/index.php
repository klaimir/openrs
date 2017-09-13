<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Copias de seguridad
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid_backup">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Realizada por</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $element) { ?>
                    <tr>                        
                        <td><?php echo $element->fecha_hora; ?></td>
                        <td><?php echo $element->tipo_backup; ?></td>
                        <td><?php echo $element->nombre_admin; ?></td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url("backup/download/" . $element->backup_id); ?>" title="Editar">
                                    <i class="ace-icon fa fa-download bigger-130"></i>
                                </a>

                                <a class="red borrar-elemento" data-id="<?php echo $element->backup_id; ?>" href="#" title="Borrar">
                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                </a>
                            </div>

                            <div class="hidden-md hidden-lg">
                                <div class="inline pos-rel">
                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">                                        
                                        <li>
                                            <a href="<?php echo site_url("backup/download/" . $element->backup_id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-download bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-elemento" data-id="<?php echo $element->backup_id; ?>" data-rel="tooltip" title="Borrar">
                                                <span class="red">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<br><br>

<?php
$back_url = $this->uri->uri_string();
$key = 'referrer_url_key';
$this->session->set_flashdata($key, $back_url);
?>

<div class="row">
    <div class="col-xs-12">
        <?php
        echo form_open($this->uri->uri_string(), 'class="form-horizontal"');
        /*
        ?>
        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="backup_type"> Tipo de copia de seguridad </label>
            <div class="col-sm-9">
                <select name="backup_type">
                    <option value="" selected disabled>- Seleccione -</option>
                    <option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '1' ? 'selected' : '')) ?>>Sólo base de datos</option>
                    <option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '2' ? 'selected' : '')) ?>>Sólo ficheros</option>
                    <option value="3" <?php echo (isset($success) && strlen($success) ? '' : (set_value('backup_type') == '3' ? 'selected' : '')) ?>>Completa</option>
                </select>
            </div>
        </div>
         * 
         */
        ?>
        <input name="backup_type" type="hidden" value="3">

        <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="file_type"> Tipo de compresión </label>
            <div class="col-sm-9">
                <select name="file_type">
                    <option value="" selected disabled>- Seleccione -</option>
                    <option value="1" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 1 ? 'selected' : '')) ?>>ZIP</option>
                    <option value="2" <?php echo (isset($success) && strlen($success) ? '' : (set_value('file_type') == 2 ? 'selected' : '')) ?>>GZIP</option>
                </select>
            </div>
        </div>
        
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="backup" value="backup">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Realizar copia de seguridad
                </button>
                <button class="btn" type="reset">
                    <i class="ace-icon fa fa-undo bigger-110"></i>
                    Reset
                </button>
            </div>
        </div>

        <?php
        echo form_close();
        ?>

    </div>
</div>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a de borrar la copia seleccionada?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url('backup'); ?>/delete/' + id;
                }
            });
        });
        
        $('#tabgrid_backup').dataTable({
            "iDisplayLength": 10,
            "oLanguage": {"sUrl": "<?php echo base_url('assets/admin/js/dataTables.spanish.txt'); ?>"},
            "aoColumns": [
                {"sType": "date-euro"},
                null,
                null,
                null
            ]
        });

    })
</script>