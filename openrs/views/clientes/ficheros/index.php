<div class="hidden">
    <button data-target="#sidebar2" data-toggle="collapse" type="button" class="pull-left navbar-toggle collapsed">
        <span class="sr-only">Toggle sidebar</span>

        <i class="ace-icon fa fa-dashboard white bigger-125"></i>
    </button>

    <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse">
        <ul class="nav nav-list">
            <li class="hover">
                <a href="<?php echo site_url('clientes/edit/'.$cliente->id); ?>">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text"> DATOS DEL CLIENTE </span>
                </a>
                <b class="arrow"></b>
            </li>
            
            <li class="hover">
                <a href="#">
                    <i class="menu-icon fa fa-calendar"></i>

                    <span class="menu-text">
                        FICHAS DE VISITA
                        <span title="" class="badge badge-transparent tooltip-error" data-original-title="2 Important Events">
                            <i class="ace-icon fa fa-exclamation-triangle red bigger-130"></i>
                        </span>
                    </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="hover">
                <a href="#">
                    <i class="menu-icon fa fa-picture-o"></i>
                    <span class="menu-text"> DEMANDAS </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="hover active">
                <a href="<?php echo site_url('clientes_ficheros/index/'.$cliente->id); ?>">
                    <i class="menu-icon fa fa-tag"></i>
                    <span class="menu-text"> FICHEROS ADJUNTOS </span>
                </a>

                <b class="arrow"></b>
            </li>
            
            <li class="hover">
                <a href="<?php echo site_url('fichas_cliente'); ?>">
                    <i class="menu-icon fa fa-file-pdf-o"></i>
                    <span class="menu-text"> FICHAS DEL CLIENTE </span>
                </a>
                <b class="arrow"></b>
            </li>
        </ul><!-- /.nav-list -->
    </div><!-- .sidebar -->
</div>

<div class="space-4"></div>
<div class="page-header">
    <div class="row">
        <div class="col-xs-12">
            <h1>
                Ficheros de <?php echo $cliente->apellidos.', '.$cliente->nombre; ?>
            </h1>
        </div>
    </div>
</div>

<?php $this->load->view('common/message', $this->data); ?>

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-info pull-right" href="<?php echo site_url($_controller . '/insert/' . $cliente->id); ?>">
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
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($elements)
                {
                    foreach ($elements as $element)
                    {
                ?>
                        <tr>
                            <td>
                                <?php echo $element->texto_fichero; ?>
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
                <?php 
                    }
                } 
                ?>
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

    })
</script>

<script type="text/javascript">
    jQuery(function($) {
       $('#sidebar2').insertBefore('.page-content');

       $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


       $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
             if(event_name == 'sidebar_fixed') {
                     if( $('#sidebar').hasClass('sidebar-fixed') ) {
                            $('#sidebar2').addClass('sidebar-fixed');
                            $('#navbar').addClass('h-navbar');
                     }
                     else {
                            $('#sidebar2').removeClass('sidebar-fixed')
                            $('#navbar').removeClass('h-navbar');
                     }
             }
       }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
    })
</script>