<div class="page-header">
    <div class="row">
        <div class="col-xs-8">
            <h1>
                Tipos de inmueble
            </h1>
        </div>

        <div class="col-xs-4">
            <button id="menu-toggler-horizontal" class="navbar-toggle menu-toggler pull-right" data-target="#sidebar_horizontal" type="button">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
</button>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div id="sidebar_horizontal" class="sidebar h-sidebar responsive">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar_horizontal', 'fixed')
        } catch (e) {
        }
    </script>

    <ul class="nav nav-list">
        <li class="hover">
            <a href="<?php echo site_url('tipos_inmueble/insert'); ?>">
                <i class="menu-icon fa fa-plus-circle"></i>
                <span class="menu-text"> Insertar </span>
            </a>

            <b class="arrow"></b>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-horizontal-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

    <script type="text/javascript">
        try {
            ace.settings.check('sidebar_horizontal', 'collapsed')
        } catch (e) {
        }
    </script>
</div>

<div class="row">
    <div class="col-xs-12">
        <table class="table table-striped table-bordered table-hover" id="tabgrid">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($elements as $element)
                {
                ?>
                <tr>
                    <td><?php echo $element->nombre_tipo; ?></td>
                    <td>
                        <div class="hidden-sm hidden-xs action-buttons">
                            <a class="green" href="<?php echo site_url($_controller."/edit/" . $element->id_tipo); ?>" title="Editar">
                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                            </a>

                            <a class="red borrar-elemento" data-id="<?php echo $element->id_tipo; ?>" href="#" title="Borrar">
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
                                        <a href="<?php echo site_url("tipos_inmueble/edit/" . $element->id_tipo); ?>" class="tooltip-success" data-rel="tooltip" title="Editar">
                                            <span class="green">
                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                            </span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="tooltip-error borrar-elemento" data-id="<?php echo $element->id_tipo; ?>" data-rel="tooltip" title="Borrar">
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
                    window.location = '<?php echo site_url(); ?>/tipos_inmueble/delete/' + id;
                }
            });
        });

    })
</script>