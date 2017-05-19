<div class="breadcrumbs" id="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>
    <ul class="breadcrumb">
        <li>
            <i class="ace-icon fa fa-home home-icon"></i>
            <a href="<?php echo site_url('provincias'); ?>">Provincias</a>
        </li>
        <li class="active"><?php echo $provincia->provincia; ?></li>
    </ul><!-- /.breadcrumb -->
</div>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Poblaciones de <?php echo $provincia->provincia; ?>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller . '/insert/' . $provincia->id); ?>">
            <i class="menu-icon fa fa-plus-circle"></i>
            <span class="menu-text"> <?php echo lang('common_btn_insert'); ?> </span>
        </a>
    </div>
</div>

<div class="space-10"></div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Activar</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($elements as $element)
                {
                    ?>
                    <tr>
                        <td><?php echo $element->poblacion; ?></td>
                        <td>
                            <input type="checkbox" class="activar" name="poblacion_<?php echo $element->id; ?>" <?php if ($element->activa) echo 'checked="checked"'; ?> data-id="<?php echo $element->id; ?>">
                        </td>
                        <td>
                            <div class="hidden-sm hidden-xs action-buttons">
                                <a class="green" href="<?php echo site_url($_controller . "/edit/" . $element->id); ?>" title="Editar">
                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                </a>

                                <a class="red borrar-elemento" data-id="<?php echo $element->id; ?>" href="#" title="Borrar">
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
                                            <a href="<?php echo site_url($_controller . "/edit/" . $element->id); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                                <span class="green">
                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="tooltip-error borrar-elemento" data-id="<?php echo $element->id; ?>" data-rel="tooltip" title="Borrar">
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

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {

        $('.borrar-elemento').click(function () {
            var id = $(this).data("id");
            bootbox.confirm("¿Estás seguro/a?", function (result) {
                if (result) {
                    window.location = '<?php echo site_url($_controller); ?>/delete/' + id;
                }
            });
        });

        $('.activar').on('change', function () {
            var id = $(this).data("id");
            if ($(this).is(':checked'))
            {
                var validar = 1;
            }
            else
            {
                var validar = 0;
            }
            $.ajax({
                url: '<?php echo site_url(); ?>/poblaciones/activar/' + id + '/' + validar,
                success: function (e) {
                    if (e != 1) {
                        alert(e);
                    }
                }
            });
        });

    })
</script>