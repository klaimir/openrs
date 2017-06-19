<?php menu_clientes ($cliente->id,"clientes_ficheros"); ?>

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
                    <th>Tipo</th>
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
                                <a target="_blank" href="<?php echo base_url($element->fichero); ?>"><?php echo $element->texto_fichero; ?></a>
                            </td>
                            <td>
                                <?php echo $element->nombre_tipo; ?>
                            </td>
                            <td>
                                <div class="hidden-sm hidden-xs action-buttons">
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
        
       show_submenu();
    })
</script>